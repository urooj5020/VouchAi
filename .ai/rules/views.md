---
paths:
  - 'resources/views/**'
---

# Views

## No @js() strings inside single-quoted Alpine attributes
Laravel v12's `@js()` (Js::from) wraps plain strings in single quotes (e.g. `'Sample Space'`). Putting that inside a single-quoted `x-data='{...}'` attribute terminates the attribute early and the rest of the Alpine markup (`@click.outside`, `@keydown.escape.window`, etc.) leaks onto the page as raw text. Inside single-quoted attributes, emit double-quoted JSON instead: `{{ Illuminate\Support\Js::encode($value) }}` (HTML-hex-escaped).
