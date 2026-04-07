# Maxus Theme

Tema personalizado de WordPress para el proyecto **Maxus Noack**.

## Requisitos

- WordPress 6.x
- PHP 8.0+
- ACF Pro (campos personalizados y opciones)

## Estructura Principal

- `functions.php`: configuración general del tema, registros de menús, encolado de estilos/scripts.
- `header.php`: cabecera principal con menú desktop y menú mobile.
- `footer.php`: pie de página.
- `front-page.php`: plantilla de inicio.
- `queries.php`: consultas personalizadas para secciones del home/singles.
- `style.css`: estilos globales del tema.
- `js/main.js`: comportamiento JS (menú mobile e interacciones base).
- `template-parts/`: bloques reutilizables.
- `custom-templates/`: plantillas personalizadas.

## Dependencias en Uso

- Normalize.css
- Swiper.js
- GSAP (registrado para uso progresivo)
- Remix Icon
- Google Fonts: Antonio + Roboto

## Configuración Inicial

1. Copiar la carpeta del tema en:
   - `wp-content/themes/maxus`
2. Activar el tema desde WordPress.
3. Activar ACF Pro.
4. Verificar menús en Apariencia > Menús.
5. Verificar campos en ACF para CPTs (Slider, Modelo, Servicio).

## Flujo de Trabajo Git

- Rama `main`: estable
- Rama `dev`: desarrollo diario

### Flujo sugerido

1. Crear rama desde `dev` para cada feature.
2. Hacer commits pequeños y descriptivos.
3. Abrir PR hacia `dev`.
4. Cuando esté validado, merge de `dev` a `main`.

## Notas de Proyecto

- Este tema se apoya en CPTs definidos en el plugin `maxus-post-types`.
- Los contenidos dinámicos (modelo, versiones, colores, fichas, galería, video) se gestionan desde ACF.
- El cotizador step-by-step debe consumir datos del CPT `modelo` y sus repeaters.

## Autoría

Desarrollado para Noack Automotriz.
