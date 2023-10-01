Api para retornar dados de usuarios vacinados usando o Laravel.

Sistema com 3 tabelas: 
    - Usuarios Aplicadores;
    - Usuarios;
    - Vacinacoes;

O sistema funciona para registrar Usuarios Aplicadores (que seriam como profissionais da saude) para que estes registrem Pacientes (tabela Usuarios) e tambem registrem as vacinacoes de cada usuario.

E necessario que o usuario aplicador esteja autenticado para registrar Pacientes e vacinacoes. A autenticacao foi implementada com o JWT.
