# Painel Impressoras - Base de Conhecimento

Este projeto é uma aplicação Laravel para gerenciar uma base de conhecimento sobre códigos de erro, soluções, manuais e informações relacionadas a impressoras e multifuncionais.

## Escopo do Projeto

*   **Área Pública:**
    *   Listagem e visualização de Códigos de Erro (com soluções, imagens e vídeos associados).
    *   Listagem e visualização de Marcas.
    *   Listagem e visualização de Modelos (com códigos de erro e manuais associados).
    *   Listagem de Manuais (download requer login).
    *   Listagem de Vídeos (público).
    *   Sistema de Comentários (com anexos: imagens, pdf, vídeo mp4, link youtube) nos Códigos de Erro para usuários logados.
    *   Sistema de Busca Global (em Códigos de Erro e Manuais).
    *   **Funcionalidade de Busca:**
        *   Busca global na página inicial por Códigos de Erro, Manuais, Marcas e Modelos.
        *   Página dedicada de resultados (`/busca`).
*   **Área Administrativa (requer login de admin):**
    *   Dashboard com visão geral.
    *   CRUD completo para Técnicos (usuários com role 'tecnico').
    *   CRUD completo para Marcas.
    *   CRUD completo para Modelos (associando a Marcas).
    *   CRUD completo para Códigos de Erro (associando a Modelos).
    *   CRUD completo para Soluções (associando a Códigos de Erro, com upload de imagens/vídeos/link YouTube).
        *   **Nota:** Uma Solução agora pode ser associada a *múltiplos* Códigos de Erro (relação N:N).
    *   CRUD completo para Manuais (associando a Modelos, com upload de arquivo).
    *   Gerenciamento de Imagens (upload e associação polimórfica).
    *   Gerenciamento de Vídeos (upload de arquivo ou link, associação polimórfica).
    *   Gerenciamento de Comentários (exclusão).
*   **Autenticação:**
    *   Login/Registro/Logout (usando Laravel Breeze).
    *   Diferenciação de papéis (Admin vs Técnico).
*   **Tecnologias:**
    *   Laravel 12.x
    *   PHP 8.2+
    *   MySQL
    *   Tailwind CSS (via Breeze)
    *   Alpine.js (via Breeze)

## Tema Visual

A aplicação utiliza um tema visual consistente chamado "Printers" tanto na área pública quanto na administrativa, caracterizado por:

*   Layouts Base (`layouts/app.blade.php`, `components/admin-layout.blade.php`):
    *   Fundo principal: `bg-gray-100`
    *   Cabeçalho da página (`<header>` abaixo da navegação): Fundo ciano claro (`bg-cyan-50`), borda inferior e texto escuro (`text-gray-700`).
    *   Rodapé: Fundo escuro (`bg-gray-800`) com texto branco (`Feito com ❤️ por JM`). Estrutura Flexbox garante que fique fixo embaixo.
*   Barras de Navegação (`layouts/navigation.blade.php`, `layouts/admin-navigation.blade.php`):
    *   Fundo escuro (`bg-gray-800`), borda inferior `border-gray-700`.
    *   Logo/Texto Principal: `text-gray-200`.
    *   Links de Navegação (`x-nav-link`, `x-responsive-nav-link`): Texto `text-gray-300`, hover `text-white`. Estado ativo com borda ciano (`border-cyan-400`) e texto branco.
    *   Botões Login/Registrar (Público): Login com fundo ciano (`bg-cyan-600`), Registrar com outline ciano claro (`border-cyan-400`, `text-cyan-400`).
    *   Dropdown do Usuário: Gatilho com texto `text-gray-300`, conteúdo com fundo `bg-gray-800` e links `text-gray-300`.
*   Botões Globais:
    *   Primário (`x-primary-button`): Fundo ciano (`bg-cyan-600`).
    *   Secundário (`x-secondary-button`): Fundo cinza claro (`bg-gray-200`).
*   Links (`<a>`): Cor padrão `text-cyan-600` (definido em `app.css` via `@layer base`).
*   Tipografia:
    *   Fonte principal: Figtree (via Bunny Fonts).
    *   Estilos base para `h1-h4`, `p`, `ul`, `ol`, `li` definidos em `app.css` via `@layer base` para hierarquia e legibilidade.

## Histórico de Customizações Recentes

*   **Tema "Printers" (Público):** Aplicado layout base (fundo, header, footer), navegação escura, cores de botões/links e tipografia base.
*   **Tema "Printers" (Admin):** Identificado o uso de `x-admin-layout` e `layouts/admin-navigation.blade.php`. Aplicado o mesmo tema visual (fundo, header, footer, navegação escura) para consistência.
*   **Rodapé:** Atualizado texto.

## TODO / Próximos Passos

*   Implementar listagem pública de Vídeos.
*   Adicionar dashboard específico para Técnicos.
*   Melhorar sistema de busca (ex: Full-Text Search, mais campos).
*   Implementar sistema de permissões mais granular (se necessário).
*   Adicionar testes automatizados.

## Instalação (Ambiente de Desenvolvimento com XAMPP)

1.  Clone o repositório.
2.  Configure o XAMPP (Apache, MySQL).
3.  Crie um banco de dados MySQL (ex: `painelimp`).
4.  Copie `.env.example` para `.env`.
5.  Configure as variáveis de ambiente no `.env`, especialmente `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
6.  Execute `composer install`.
7.  Execute `php artisan key:generate`.
8.  Execute `php artisan migrate --seed` para criar as tabelas e popular com dados iniciais.
9.  Execute `npm install && npm run dev` (para compilar assets do frontend).
10. Configure seu Virtual Host no Apache ou use `php artisan serve`.

## Credenciais Padrão (Após Seed)

*   **Admin:** `admin@example.com` / `password`
*   **Técnico:** `tecnico@example.com` / `password`
