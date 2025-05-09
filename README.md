# Painel Impressoras - Base de Conhecimento

Este projeto é uma aplicação Laravel para gerenciar uma base de conhecimento sobre manuais e informações relacionadas a impressoras e multifuncionais, com foco na indexação e busca de conteúdo em PDFs.

## Escopo do Projeto

*   **Área Pública:**
    *   Listagem e visualização de Marcas (com busca).
    *   Listagem e visualização de Modelos (com busca).
    *   Visualização de detalhes do Modelo, com busca interna nos manuais indexados do modelo e link para página de manuais.
    *   Visualização/Download de Manuais por Modelo (acessível via link da página do Modelo, download requer login).
    *   Visualização de PDF de manual com abertura em página específica e busca interna.
    *   Sistema de Busca Global (em Manuais, Marcas, Modelos e conteúdo indexado de PDFs).
*   **Área Administrativa (requer login de admin):**
    *   Dashboard com visão geral.
    *   CRUD completo para Técnicos (usuários com role 'tecnico').
    *   CRUD completo para Marcas.
    *   CRUD completo para Modelos (associando a Marcas).
    *   CRUD completo para Manuais (associando a Modelos, com upload de arquivo e indexação automática de PDF).
    *   Gerenciamento de Imagens (upload e associação polimórfica).
    *   Gerenciamento de Vídeos (upload de arquivo ou link, associação polimórfica).
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
    *   Estilos base para `h1-h4`, `p`, `ul`, `ol`, `li` definidos em `app.css` via `