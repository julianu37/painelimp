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

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
