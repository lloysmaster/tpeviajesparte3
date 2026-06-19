| Método | Endpoint        | Acción                                                        | Quién lo hace |
|--------|-----------------|---------------------------------------------------------------|---------------|
| GET    | /api/viajes     | Lista todos los viajes (colección completa)                   | Miembro A     |
| GET    | /api/viajes/:id | Obtiene un viaje específico por ID                            | Miembro B     |
| POST   | /api/viajes     | Agrega un nuevo viaje (requiere autenticación)                | Miembro B     |
| PUT    | /api/viajes/:id | Modifica un viaje existente (requiere autenticación)          | Miembro A     |
