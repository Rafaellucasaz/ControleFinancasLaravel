# Sistema de Controle de Finanças de Programas/Projetos Acadêmicos

Este sistema foi desenvolvido para gerenciar o orçamento, pedidos e gastos de programas/projetos acadêmicos.

## Entidades

### **Programa**
Representa um programa ou projeto acadêmico. Cada programa possui um orçamento inicial, que será controlado ao longo do tempo com registros de pedidos e gastos.

### **Pedido**
Refere-se a um pedido ou gasto realizado dentro de um programa. 

### **Coordenador**
O coordenador é a pessoa responsável por um programa

## Usuários

### **Admin**
Usuário com permissões totais sobre o sistema. 

### **Coordenador**
Usuário responsável por um programa específico. 

### **Visitante**
Usuário com permissão apenas para visualizar gráficos de gastos de todos os programas registrados no sistema.

## Funcionalidades

### **Admin**
- **Gerenciar coordenadores**: Cadastrar e deletar coordenadores no sistema.
- **Gerenciar programas**: Criar, editar e excluir programas.
- **Gerenciar pedidos**: Registrar, editar e excluir pedidos realizados pelos coordenadores de programas.
- **Gerar relatório de gastos**: Gerar relatórios detalhados de gastos de todos os programas em formato PDF.

### **Coordenador**
- **Orçamento inicial**: Cadastrar o orçamento inicial para o seu programa.
- **Gerenciamento de pedidos**: Visualizar os pedidos registrados no sistema para o seu programa.
- **Histórico de Gastos**: Visualizar os gastos totais do programa.


### **Geral**
- **Gráficos financeiros**: Visualizar gráficos de gastos de todos os programas registrados no sistema.



## Tecnologias Utilizadas
- Laravel
- HTML, CSS, JavaScript
- PostgreSQL



