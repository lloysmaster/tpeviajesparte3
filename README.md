| Método | Endpoint (Ruta) | Descripción                                                                                     | Query Params / Body Requerido                                                        | Códigos HTTP de Respuesta                                                                                                          |
|--------|-----------------|-------------------------------------------------------------------------------------------------|--------------------------------------------------------------------------------------|------------------------------------------------------------------------------------------------------------------------------------|
| GET    | /api/viajes     | Devuelve la colección entera de viajes. Permite filtrar y ordenar los resultados dinámicamente. | Query Params (Opcionales):?pais=pais?sort=campo?order=ASC/DESC                  | 200 OK: Retorna el JSON con el listado.404 Not Found: Si no se encontraron resultados para el filtro.                              |
| GET    | /api/viajes/:id | Obtiene los detalles de un viaje específico buscándolo por su identificador único (ID).         | Parámetro URL: :id (Numérico)                                                        | 200 OK: Retorna el JSON del viaje solicitado.404 Not Found: Si el viaje no existe.                                                 |
| POST   | /api/viajes     | Agrega un nuevo registro de viaje a la base de datos.                                           | Body (JSON):nombre_ciudad (String)pais (String)descripcion (String)precio (Numérico) | 201 Created: Viaje insertado correctamente.400 Bad Request: Faltan datos requeridos.500 Internal Error: Falla en la base de datos. |
| PUT    | /api/viajes/:id | Modifica de manera completa un viaje existente en la base de datos según su ID.                 | Parámetro URL: :idBody (JSON):nombre_ciudadpaisdescripcionprecio                     | 200 OK: Viaje modificado correctamente.400 Bad Request: Faltan completar datos.404 Not Found: Si el viaje no existe.               |
| DELETE | /api/viajes/:id | Elimina un viaje de la base de datos según su identificador único.                              | Parámetro URL: :id (Numérico)                                                        | 200 OK: Viaje eliminado exitosamente.404 Not Found: Si el viaje no existe.                                                         |
| PATCH  | /api/viajes/:id | Modifica parcialmente los datos de un viaje específico.                         | Parámetro URL: :idBody: Campos parciales                                             | N/A                                                                                                                                |

ejemplo de put api/viajes/1

{
  "nombre_ciudad": "San Carlos de Bariloche",
  "pais": "Argentina",
  "descripcion": "Destino principal de la Patagonia con centro de esquí y gran oferta gastronómica.",
  "precio": 1650.00
}
ejemplo de post api/viajes

{
  "nombre_ciudad": "Bariloche",
  "pais": "Argentina",
  "descripcion": "Ciudad turística conocida por sus paisajes de montaña y lagos.",
  "precio": 1500.50
}

get /api/viajes parametros generales
