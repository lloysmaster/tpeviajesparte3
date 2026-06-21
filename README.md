## **Resumen de la API de Viajes**

| Método | Endpoint | Descripción | Códigos de Respuesta |
| :---- | :---- | :---- | :---- |
| **GET** | /api/viajes | Obtiene la lista de viajes (filtrable). | 200 |
| **GET** | /api/viajes/:id | Detalles de un viaje específico. | 200, 404 |
| **POST** | /api/viajes | Crea un nuevo viaje. | 201, 400, 500 |
| **PUT** | /api/viajes/:id | Actualización completa (Reemplazo). | 200, 400, 404 |
| **PATCH** | /api/viajes/:id | Actualización parcial. | 200, 400, 404 |
| **DELETE** | /api/viajes/:id | Elimina un viaje. | 200, 404 |

## **Detalle de Operaciones (POST vs PUT)**

trabajando con el recurso ubicado en /api/viajes/1 ...

### **POST (/api/viajes)**
   
{  
  "nombre\_ciudad": "Bariloche",  
  "pais": "Argentina",  
  "descripcion": "Ciudad turística conocida por sus paisajes de montaña y lagos.",  
  "precio": 1500.50  
}

### **PUT (/api/viajes/1)**
  
{  
  "nombre\_ciudad": "San Carlos de Bariloche",  
  "pais": "Argentina",  
  "descripcion": "Destino principal de la Patagonia con centro de esquí y gran oferta gastronómica.",  
  "precio": 1650.00  
}

## **Filtrado y Ordenamiento (GET)**

| Parámetro | Tipo | ¿Obligatorio? | Ejemplo de uso |
| :---- | :---- | :---- | :---- |
| pais | string | No | ?pais=Argentina |
| sort | string | No | ?sort=precio |
| order | string | No | ?order=DESC |

### **Ejemplos de combinación**

* **Filtrado simple:** /api/viajes?pais=argentina  
* **Ordenamiento:** /api/viajes?sort=precio\&order=DESC  
* **Combinado:** /api/viajes?pais=argentina\&sort=precio\&order=ASC
