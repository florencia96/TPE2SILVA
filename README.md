## endpoint 
API: http://localhost/tucarpetalocal/silva3/api/trips

GET -> /api/trips (me devuelve todos los viajes)
       /api/comentarios (me devuelve todos los comentarios)
por ejemplo http://localhost/silva3/api/trips (me devuelve todos los viajes)
            http://localhost/silva3/api/comentarios (me devuelve todos los comentarios)

GET:ID-> /api/trips/:id (me devuelve un viaje con cierto id)
         /api/comentarios/:id (me devuelve un comentario con cierto id)
por ejemplo http://localhost/silva3/api/trips/1 con GET me devolvera el viaje con id=1
            http://localhost/silva3/api/comentarios/1 con GET me devuelve el comentario con id=1

POST-> /api/trips (me agrega un nuevo viaje)
       /api/comentarios (me agrega un nuevo comentario)
por ejemplo http://localhost/silva3/api/trips con POST me agrega un nuevo viaje
            http://localhost/silva3/api/comentarios con POST me agrega un nuevo comentario

DELETE:ID-> /api/trips/:id (me elimina un viaje con cierto id)
            /api/comentarios/:id (me elimina un comentario con cierto id)
por ejemplo http://localhost/silva3/api/trips/1 con DELETE me elimina el viaje con id=1
            http://localhost/silva3/api/comentarios/1 con DELETE me elimina el comentario con id=1