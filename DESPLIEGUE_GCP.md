# Guía de despliegue en GCP — JeWeblryStore (Entregable 2)

Esta guía despliega el proyecto **JeWeblryStore** (Laravel 13 / PHP 8.3, ubicado en la
carpeta `JeWeblryStore/`) en **Google Cloud Platform (GCP)** usando:

- **Cloud SQL (MySQL)** como base de datos (Tutorial 05).
- **Docker** para empaquetar la aplicación (Tutorial 06).
- **Docker Swarm + Docker Service** sobre un **grupo de instancias (MIG)** con varias
  réplicas, igual que el microservicio del Tutorial 07.
- **Un balanceador de carga HTTP(S) externo con una IP estática única**, de modo que la
  aplicación **siempre responde desde una sola IP**, sin importar en qué nodo/réplica caiga
  la petición. Esto cumple el requisito del entregable: *"un balanceador para que sea solo
  una IP siempre"*.

> **Importante sobre créditos:** Cloud SQL y los balanceadores consumen crédito. Cuando
> termines de evaluar el entregable, **detén/elimina** la instancia de Cloud SQL, el grupo de
> instancias y el balanceador para no gastar crédito (ver sección 8).

---

## Arquitectura

```
                           Internet
                              │
                              ▼
                 ┌───────────────────────────┐
                 │  IP ESTÁTICA ÚNICA (una)   │  ← siempre la misma IP
                 │  Balanceador HTTP externo  │
                 └───────────────────────────┘
                              │  (reparte el tráfico por salud/carga)
              ┌───────────────┴────────────────┐
              ▼                                 ▼
      ┌──────────────┐                  ┌──────────────┐
      │   nodo-01    │                  │   nodo-02    │   ← Managed Instance Group
      │ (Docker)     │   Docker Swarm   │ (Docker)     │     (e2-micro, Debian 13)
      │ réplicas app │ ───────────────► │ réplicas app │
      └──────────────┘                  └──────────────┘
              │                                 │
              └───────────────┬─────────────────┘
                              ▼
                   ┌─────────────────────┐
                   │ Cloud SQL (MySQL)   │  ← base de datos gestionada
                   └─────────────────────┘
```

La aplicación en cada contenedor imprime en el footer / logs el `hostname()` del contenedor,
así que al recargar verás que el balanceador reparte el tráfico entre réplicas (igual que la
"Nota final" del Tutorial 07), pero **el usuario siempre entra por la misma IP**.

---

## 0. Antes de empezar

- Repositorio: `https://github.com/gljaramilloc/Proyecto_ArquitecturaSoftware`
- La app Laravel vive en `JeWeblryStore/`.
- Ya se agregaron a este repo los archivos de infraestructura:
  - `JeWeblryStore/Dockerfile`
  - `JeWeblryStore/docker/entrypoint.sh`
  - `JeWeblryStore/.dockerignore`
  - `.github/workflows/docker-image.yml` (CI → Docker Hub)
- Ten lista tu cuenta de GCP con los créditos activados (correo del docente, Tutorial 05).

---

## 1. Crear la base de datos en Cloud SQL (MySQL)

> Sigue el **Tutorial 05, sección D**. Resumen:

1. En GCP ve a **Cloud SQL → Instances → Create Instance → MySQL**.
2. Habilita las APIs sugeridas (Compute Engine API, Cloud SQL Admin API).
3. Edición **Enterprise**, preset **Sandbox** (o **Development**).
4. Configura:
   - **Instance ID:** `jeweblrystore-db`
   - **Database version:** MySQL 8.0 / 8.4
   - **Password:** define una contraseña fuerte (guárdala).
   - Machine: `1 vCPU` — Storage: `10 GB SSD` (sin aumento automático).
5. Crea la instancia (tarda ~5 min).
6. En la instancia → **Databases → Create database** → nombre: `jeweblrystore`.
7. **Connections → Networking → Add a network:** autoriza `0.0.0.0/0` (nombre `all`),
   marca *I acknowledge the risks* → **Done** → **Save**.
8. **Connections → Security:** marca **Allow unencrypted network traffic**.
9. Anota, en **Overview → Connect to this instance**, la **Public IP address** y el puerto
   `3306`. Esos serán tu `DB_HOST` y `DB_PORT`.

Datos que usarás más adelante (ejemplo):

| Variable      | Valor                        |
|---------------|------------------------------|
| `DB_CONNECTION` | `mysql`                    |
| `DB_HOST`     | *(IP pública de Cloud SQL)*  |
| `DB_PORT`     | `3306`                       |
| `DB_DATABASE` | `jeweblrystore`              |
| `DB_USERNAME` | `root`                       |
| `DB_PASSWORD` | *(la que definiste)*         |

---

## 2. Publicar la imagen en Docker Hub con GitHub Actions

> Sigue el **Tutorial 07, secciones G**. El `Dockerfile` y el workflow ya están en el repo.

1. Crea una cuenta en <https://hub.docker.com/> y un repositorio **público** llamado
   `jeweblrystore`.
2. En GitHub, en tu repo → **Settings → Secrets and variables → Actions → New repository
   secret**, crea:
   - `DOCKERHUB_USER` = tu usuario de Docker Hub.
   - `DOCKERHUB_PASS` = tu contraseña o **Access Token** de Docker Hub.
3. Haz push a `main`. El workflow `.github/workflows/docker-image.yml` construye la imagen
   desde `JeWeblryStore/` y la publica como:

   ```text
   <TU_USUARIO>/jeweblrystore:latest
   ```

4. Verifica en GitHub → pestaña **Actions** que el workflow quede en verde, y en Docker Hub
   que aparezca el tag `latest`.

> A partir de aquí, **cada push a `main` actualiza automáticamente la imagen** en Docker Hub.

---

## 3. Crear la plantilla de instancia (Docker preinstalado)

> Sigue el **Tutorial 07, sección A**.

1. GCP → **Compute Engine → Instance Templates → Create instance template**.
2. Nombre: `template-jeweblry-micro`. Máquina: **e2-micro**. Imagen: **Debian 13 (Trixie)**.
3. **Firewall:** marca *Allow HTTP traffic* y *Allow HTTPS traffic*, y **también marca
   *Allow Load Balancer Health Checks*** (necesario para que el balanceador considere sanos
   los nodos).
4. **Advanced options → Management → Automation → Startup script:** pega el script de
   instalación de Docker del Tutorial 07 (instala `docker-ce`, plugins y habilita el
   servicio). Es el mismo bloque `#!/bin/bash … sudo systemctl enable --now docker`.
5. **Create.**

---

## 4. Crear el grupo de instancias (MIG) con 2 nodos

> Sigue el **Tutorial 07, sección B**.

1. Compute Engine → **Instance Templates**, selecciona `template-jeweblry-micro` →
   **Create Instance group**.
2. Tipo: **New managed instance group (stateless)**.
3. Nombre: `grupo-jeweblry-micro`. Template: el anterior. **Number of instances: 2**.
4. **Location:** *Single zone* (por ejemplo `us-central1-a`).
5. **Autoscaling:** *Off: do not autoscale*, mínimo `1`, máximo `2`.
6. **Create.** Espera ~5 min a que aparezcan las 2 instancias con Docker instalado
   (verifícalo con `docker -v` por SSH en cada una).

A la primera instancia la llamaremos **nodo-01** y a la segunda **nodo-02**.

---

## 5. Inicializar Docker Swarm y desplegar el servicio

> Sigue el **Tutorial 07, secciones D, E y H**. Reemplaza `<TU_USUARIO>` por tu usuario de
> Docker Hub.

**En nodo-01 (SSH):**

```bash
sudo docker swarm init
# Guarda el comando "docker swarm join --token ..." que devuelve.
```

**En nodo-02 (SSH):** pega el comando `docker swarm join --token ...` que te dio nodo-01.

**De nuevo en nodo-01**, verifica y crea el servicio con réplicas, cada contenedor
escuchando en el puerto 80 y publicando el 80 del host:

```bash
sudo docker node ls

sudo docker service create \
  --name jeweblrystore \
  --replicas 4 \
  -p 80:80 \
  --env DB_CONNECTION=mysql \
  --env DB_HOST=<IP_PUBLICA_CLOUD_SQL> \
  --env DB_PORT=3306 \
  --env DB_DATABASE=jeweblrystore \
  --env DB_USERNAME=root \
  --env DB_PASSWORD='<TU_PASSWORD>' \
  --env APP_ENV=production \
  --env APP_DEBUG=false \
  <TU_USUARIO>/jeweblrystore:latest

sudo docker service ps jeweblrystore   # ver en qué nodos quedaron las réplicas
```

Gracias a la *routing mesh* de Swarm, **cualquiera de los 2 nodos** responde en el puerto 80
y reparte internamente entre las 4 réplicas. Puedes probar entrando por la IP pública de
nodo-01 o nodo-02; al recargar, el contenedor que atiende cambia.

> Hasta aquí ya tienes el microservicio corriendo, pero con **dos IPs** (una por nodo). El
> siguiente paso añade **una sola IP** permanente mediante el balanceador.

---

## 6. Balanceador de carga HTTP externo → **una sola IP siempre**

El objetivo del entregable es que el usuario **siempre use una única IP**, aunque por detrás
haya varios nodos/réplicas. Lo logramos con un **Load Balancer HTTP(S) externo global** y
una **IP estática reservada**.

### 6.1 Reservar la IP estática única

GCP → **VPC network → IP addresses → Reserve external static address**:

- Nombre: `ip-jeweblry`
- Tipo: **Global**, **IPv4**, nivel **Premium**.
- **Reserve.** Anota esta IP: será **la única IP pública** de tu aplicación.

### 6.2 Crear el Health Check

GCP → **Compute Engine → Health checks → Create health check**:

- Nombre: `hc-jeweblry`
- Protocolo: **HTTP**, puerto **80**, ruta **`/`**.
- Intervalo 10s, timeout 5s, umbrales 2/3.

### 6.3 Regla de firewall para el health check

GCP → **VPC network → Firewall → Create firewall rule**:

- Nombre: `allow-lb-health-checks`
- Dirección: **Ingress**, acción **Allow**.
- **Source IP ranges:** `130.211.0.0/22` y `35.191.0.0/16` (rangos de los health checks de
  Google).
- **Protocols/ports:** TCP `80`.
- Targets: *All instances in the network* (o por tag si usaste tags).

### 6.4 Crear el balanceador

GCP → **Network Services → Load balancing → Create load balancer**:

1. Tipo: **Application Load Balancer (HTTP/S)**.
2. Público (**From Internet to my VMs**), **Global external**.
3. **Frontend configuration:**
   - Protocolo **HTTP**, puerto **80**.
   - **IP address:** selecciona la IP estática `ip-jeweblry` reservada en 6.1.
   *(Opcional: añade un frontend HTTPS en el puerto 443 con un certificado
   administrado por Google si tienes dominio.)*
4. **Backend configuration → Create a backend service:**
   - Tipo de backend: **Instance group** → selecciona `grupo-jeweblry-micro`.
   - Puerto **80**, **Balancing mode: Utilization** (o Rate).
   - **Health check:** `hc-jeweblry` (el de 6.2).
5. **Routing rules:** por defecto (todo el tráfico `/*` al backend anterior).
6. **Create** y espera unos minutos a que el backend quede **Healthy**.

### 6.5 Probar

Abre en el navegador (solo **HTTP**, igual que en los tutoriales):

```text
http://<IP_ESTATICA_ip-jeweblry>/
```

Deberías ver **JeWeblryStore** y, al recargar varias veces, el balanceador repartiendo entre
los nodos/réplicas — **pero siempre entrando por la misma IP**. ✅ Requisito cumplido.

---

## 7. Verificación del entregable (checklist)

- [ ] Cloud SQL MySQL creada, con base `jeweblrystore` y acceso abierto.
- [ ] Imagen `<TU_USUARIO>/jeweblrystore:latest` publicada en Docker Hub por GitHub Actions.
- [ ] MIG con 2 instancias `e2-micro` Debian 13 y Docker instalado.
- [ ] Docker Swarm inicializado y servicio `jeweblrystore` con varias réplicas.
- [ ] IP estática **única** reservada.
- [ ] Load Balancer HTTP externo apuntando al grupo de instancias, backend **Healthy**.
- [ ] La app abre y funciona desde `http://<IP_ESTATICA>/` (registro/login/catálogo).
- [ ] Al recargar, cambian las réplicas pero la **IP sigue siendo la misma**.

---

## 8. Apagar para no gastar créditos

Cuando termines la evaluación:

1. **Load balancing:** elimina el balanceador, backend service, health check y la
   regla de firewall.
2. **VPC → IP addresses:** libera la IP estática `ip-jeweblry`.
3. **Compute Engine:** elimina el grupo de instancias `grupo-jeweblry-micro` y la plantilla.
4. **Cloud SQL:** **Stop** (o Delete) la instancia `jeweblrystore-db` (es lo que más gasta).

---

## Anexo — Comandos Docker útiles (Tutorial 07)

```bash
sudo docker service ls                       # listar servicios
sudo docker service ps jeweblrystore         # réplicas y en qué nodo están
sudo docker service scale jeweblrystore=6    # escalar réplicas
sudo docker service update --image <TU_USUARIO>/jeweblrystore:latest jeweblrystore
sudo docker container ls                     # contenedores del nodo actual
sudo docker system prune -a                  # liberar espacio
```

### (Opcional) CD automático con Watchtower

Para que cada push a GitHub actualice automáticamente los contenedores en GCP (reto del
Tutorial 07), ejecuta en cada nodo:

```bash
sudo docker run -d --name watchtower \
  -v /var/run/docker.sock:/var/run/docker.sock \
  containrrr/watchtower --interval 60
```

Así, cada vez que GitHub Actions publique una nueva imagen en Docker Hub, Watchtower la
detecta y recrea el contenedor con la versión nueva.
