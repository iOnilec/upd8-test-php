-- script SQL que a partir do ID do cliente, retorne todos os representantes que podem atendê-lo.
SELECT r.*
FROM representatives r
INNER JOIN clients c ON c.city_id = r.city_id
WHERE c.client_id = :client_id;

-- Gerar um script SQL que retorne todos os representantes de uma determinada cidade.
SELECT * FROM representatives WHERE city_id = :city_id;
