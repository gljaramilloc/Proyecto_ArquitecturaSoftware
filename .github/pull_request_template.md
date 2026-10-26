## Issue que cierra

Closes #

## Tipo de cambio

- [ ] Corrección de la entrega 1 (`correccion-entrega1`)
- [ ] Funcionalidad del Entregable 2 (`entregable2`)
- [ ] Bug
- [ ] Usabilidad
- [ ] Documentación

## Qué cambia

<!-- Describe en pocas líneas qué hiciste y por qué. -->

## Archivos o módulos principales

<!-- Por ejemplo: app/Models/Jewel.php, app/Actions/CreateOrderAction.php, lang/es/ -->

## Lista de verificación del autor

**Estilo y reglas del curso**
- [ ] Cumple la guía de estilo y las reglas de programación del equipo.
- [ ] Todos los métodos nuevos o modificados tienen comentario con el formato acordado.
- [ ] No hay texto quemado en vistas ni controladores: todo sale de `lang/` (es y en, mismas claves).

**Arquitectura**
- [ ] Los modelos son solo clases del dominio: sin traits y sin setters de `id`, `created_at` ni `updated_at`.
- [ ] Los controladores reciben el objeto Eloquent, no el id.
- [ ] Ningún controlador crea modelos directamente (se usa una Action).
- [ ] No se repite `middleware()` en el controlador si la ruta ya lo aplica.

**Calidad**
- [ ] Probé el cambio en local (`php artisan migrate:fresh --seed`) y funciona.
- [ ] Las pruebas pasan (`php artisan test`).
- [ ] Los formularios conservan lo escrito cuando falla la validación.
- [ ] Hice commits propios con mensajes claros (sin commits ajenos ni archivos `.env`, `vendor` o `node_modules`).

## Capturas o evidencia

<!-- Pega una captura de pantalla o la respuesta del servicio si aplica. -->

## Para la arquitecta (Gisel)

- [ ] Revisé el código contra la guía de estilo y las reglas.
- [ ] El PR cierra el issue correcto y tiene etiquetas e hito.
- [ ] Aprobado para integrar a `main`.
- [ ] Cambios solicitados (ver comentarios).