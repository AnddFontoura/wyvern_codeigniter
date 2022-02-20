# Wyvern

Esse projeto é basicamente uma loja virtual.

# Instalação

Foi criado para rodar em qualquer configuração de máquina com qualquer configuração de PHP 7+. É necessário observar que precisa estar ativo o 'mod_rewiter' do apache e habilitado o uso de .htaccess.

Só copiar todo o projeto dentro da pasta de www.

Copiar também o projeto 'wyvern_database' para criação do banco de dados, lembrando que ele é Laravel então tem suas próprias maneiras de funcionar.

# Regras de desenvolvimento

Controller:
```
Os controlers são sempre em singular e sem sufixo, nome do arquivo deve ser o mesmo nome da classe. Controller com dois ou mais nomes devem ser escritos em letras minusculas e sem espaço.

Os métodos das classes camelCase se forem páginas (com view)
Os métodos das classes com _ se forem regras de negócio ou funções (unique_id)
```
Model:
```
Os models sempre no singular e tem sufixo _model, nome do arquivo deve ser o nome da classe. Segue as mesmas regras do controller.
```

Helpers:
```
Não há regras específicas para os helpers, apenas não esquecer de checar se a função existe antes de criar uma nova.
```

# configuração

Config/config.php tem as configurações do sistema. Dificilmente será necessário editar configuração pro sistema funcionar, mas se você percisar fazer algo pra funcionar na sua máquina, não comite. Inclua o arquivo no gitignore

# Git ignore
As pastas de Upload, cache e sessions não devem ser comitadas.
