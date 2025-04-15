# PainelIMP - Painel Interno de Manuais e Procedimentos

Este projeto é um painel web desenvolvido em Laravel 12 para gerenciar códigos de erro, soluções, manuais técnicos, imagens e vídeos relacionados a equipamentos.

## Funcionalidades Principais

*   **Autenticação:** Sistema de login e registro usando Laravel Breeze.
*   **Perfis de Usuário:**
    *   **Visitante:** Visualiza códigos de erro públicos, manuais públicos (sem download), imagens e vídeos.
    *   **Técnico:** Acessa todo conteúdo técnico, comenta em códigos de erro, faz download de manuais e edita seu perfil.
    *   **Administrador:** Acesso total ao sistema, gerenciamento de técnicos, conteúdos (códigos, soluções, manuais, mídias) e comentários.
*   **Gerenciamento de Conteúdo:** CRUD completo para códigos de erro, soluções, manuais, imagens e vídeos através do painel administrativo.
*   **Comentários:** Técnicos podem adicionar comentários em códigos de erro (sem moderação, apenas exclusão pelo admin).
*   **Uploads:** Armazenamento local de manuais (PDF, etc.), imagens e vídeos (MP4) com validação.
*   **Vídeos:** Suporte para links do YouTube ou upload de arquivos.
*   **Tecnologias:** Laravel 12.x, TailwindCSS, Blade, MySQL.

## Estrutura Inicial

*   Projeto Laravel 12 criado.
*   Laravel Breeze instalado e configurado (Blade stack).
*   Banco de dados MySQL configurado (`painelimp`).
*   Migrations criadas e executadas para as tabelas: `users` (com `role` e `avatar`), `codigos_erro`, `solucoes`, `comentarios`, `manuais`, `imagens`, `videos`.
*   Models Eloquent criados com relacionamentos definidos (`User`, `CodigoErro`, `Solucao`, `Comentario`, `Manual`, `Imagem`, `Video`).
*   Seeders criados e executados para popular o banco com dados iniciais (usuário admin, técnico, exemplos de códigos, soluções, comentários e manuais).
*   Storage link criado (`php artisan storage:link`).
*   Middleware `RoleMiddleware` criado e registrado (`role:admin`).
*   Controllers básicos gerados.
*   Estrutura de rotas definida em `routes/web.php`.

## Próximos Passos

*   Implementar a lógica nos Controllers.
*   Criar as Views (Blade) para as áreas pública, de técnico e administrativa.
*   Implementar a lógica de upload de arquivos (manuais, imagens, vídeos) com validação.
*   Desenvolver a interface do usuário com TailwindCSS.
*   Refinar validações (Request classes).
*   Implementar testes.
