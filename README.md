# Sistema de Cupons de Desconto

Este projeto é uma aplicação Laravel simples para demonstrar a aplicação e remoção de cupons de desconto em produtos.

## 🔧 Tecnologias

- PHP 8.2
- Laravel 10+
- MySQL
- Docker / Docker Compose

---

## 🚀 Como executar com Docker

### Pré-requisitos:

- Docker
- Docker Compose

### Passo a passo:

1. Clone o repositório:

```bash
git clone https://github.com/jonatasvandrade/Cupom.git
cd Cupom
```

2. Copie o arquivo `.env.example` e renomeie para `.env`:

```bash
cp .env.example .env
```

3. Gere a key da aplicação:

```bash
docker-compose run --rm app php artisan key:generate
```

4. Suba os containers:

```bash
docker-compose up -d
```

5. Acesse o container da aplicação e rode as migrations (e seeders, se necessário):

```bash
docker-compose exec app php artisan migrate --seed
```

6. A aplicação estará disponível em:  
[http://localhost:8000](http://localhost:8000)

---

## 👤 Criar uma conta de usuário

1. Acesse a aplicação no navegador.
2. Clique em **"Registrar"** no canto superior direito.
3. Preencha os dados e confirme seu e-mail se necessário (pode ser desabilitado no `.env` com `MAIL_MAILER=log`).
4. Faça login com o e-mail e senha cadastrados.

---

## 💸 Como usar o sistema de desconto

1. Após fazer login, você será redirecionado para o **Dashboard**.
2. No formulário, digite um **código de cupom válido**.
3. Clique no botão verde **"Aplicar Cupom"**.
4. O desconto será calculado e mostrado logo abaixo.
5. Caso deseje, clique em **"Remover Desconto"** para cancelar a aplicação do cupom.

---

## 🎫 Regras dos Cupons

- Os cupons têm um campo `max_uso` que limita o número de utilizações.
- O sistema verifica se o cupom ainda pode ser usado antes de aplicar.
- O desconto é aplicado sobre o valor total dos produtos listados.

---

## 📁 Estrutura Básica

- `CupomController`: Lógica de aplicação/remoção do cupom.
- `Produto`: Model e migration com produtos de exemplo.
- `Cupom`: Model e migration com regras de desconto.
- `resources/views/dashboard.blade.php`: Interface do usuário.

## Eemplo de cupons

| Código         | Tipo       | Valor  | Máximo de Usos |
|----------------|------------|--------|----------------|
| DESCONTO10     | Percentual | 10%    | 100            |
| FRETEGRATIS    | Fixo       | R$ 20  | 50             | 
| BEMVINDO       | Percentual | 15%    | 1              | 
| BLACKFRIDAY    | Percentual | 50%    | 500            |
| PROMO5         | Fixo       | R$ 5   | 1000           | 

Feito por [Jonatas Viana Andrade](https://github.com/jonatasvandrade)
