TPE-2-Tomas Caraccioli WEB 2


ENDPOINTS:

GET || /api/products Devuelve todos los productos

GET || /api/products/id Devuelve el producto con la ip espesificada. 

DELETE || /api/products/id Elimina al producto con la ip ingresada en caso de que exista uno.

POST || /api/products Agrega un producto con la informaci�n dada en un JSON dentro del body del request.
(se completan todos los campos exptuando el Id ya que es autoincremental)

Todo esto se repite con las variaciones /api/sellers y /api/users.