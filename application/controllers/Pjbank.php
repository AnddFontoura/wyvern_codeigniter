<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use GuzzleHttp\Client;

class PJBank extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    
    //Chave de API
    protected $api;
	protected $url; 
	
	function __construct()
	{
		CI_Controller::__construct();
		$this->load->model('pjbank_model');
	
		#Sandbox
		$this->url = "https://sandbox.pjbank.com.br";
		
		#Produção
	}

	public function createAccount() {

		/* https://docs.pjbank.com.br/#e7c5a754-eb87-4068-8304-f12c536964ad
		nome_empresa: Empresa de Exemplo
		Razão social da empresa. Será usado no campo “beneficiário” do boleto, length (3-80).

		conta_repasse: 99999-9
		Número da conta bancaria que será feito o repasse, com dígito. Formato: 99999-9, 9999-99, length (0-7).

		agencia_repasse: 0001
		Número da agência que será feito o repasse, com ou sem dígito dependendo do banco. Formato: 99999, 9999-9, length (2-6).

		banco_repasse: 001
		Número do banco que será feito o repasse, com 3 dígitos. Para uma lista de bancos permitidos, verifique o endpoint [GET] /bancos, length (3-3).

		cnpj: 50282264000153
		CNPJ da empresa, somente números. O CNPJ deve ser o mesmo da razão social e da conta de repasse. Será exposto no boleto bancário. Length (11-14).

		ddd: 19
		DDD do telefone da empresa, somente números, length (2-2).

		telefone: 40096830
		Telefone da empresa, sem DDD. Somente números, length (8-10).

		email: atendimento@pjbank.com.br
		E-mail da empresa. Para uso interno, length (3-80).

		agencia: 
		Opcional. Código de identificação do parceiro, fornecido pelo PJBank, length (4-4).
		*/
		
		$data_send = [
			'nome_empresa' => "Batata",
			'conta_repasse' => '99999-9',
			'agencia_repasse' => '0001',
			'banco_repasse' => '033',
			'cnpj' => '00659351000109',
			'ddd' => '41',
			'telefone' => '400096830',
			'email' => ['contato@contato.com.br'],
			'agencia' => ''
		];

		$client = new GuzzleHttp\Client(['base_uri' => $this->url]);
		$response = $client->request('POST', 'recebimentos', ['form_params' => $data_send]);
		$body = $response->getBody();
		
		$body = (string)$body;
		$body = json_decode($body);
		
		// Implicitly cast the body to a string and echo it
		//echo "<pre>";
		//var_dump( ($body));
		//echo "</pre>";

		//echo "<hr>".$body->{'credencial'}."<hr>";

		return $body;
		
		//Body:
		//{ "status": "201", "msg": "Sucesso ao credenciar", "credencial": "08e8abee0a5bd2c459a457ffc266cfb920b2921e", "chave": "1def3cd6a05dd8e8e9e06690fcdbdf7a5746c088", "conta_virtual": "214653", "agencia_virtual": ""
	}

	public function createPayslip () {
		/*
			vencimento: 12/30/2019
			Vencimento da cobrança no formato MM/DD/AAAA. length (10-10).

			valor: 50.75
			Valor a ser cobrado em reais. Casas decimais devem ser separadas por ponto, máximo de 2 casas decimais, não enviar caracteres diferentes de número ou ponto. Não usar separadores de milhares. Exemplo: 1000.98.

			juros: 0
			Taxa de juros ao mês. Valor informado será dividido por 30 pra ser encontrado a taxa diária. Casas decimais devem ser separadas por ponto, máximo de 2 casas decimais, não enviar caracteres diferentes de número ou ponto. Não usar separadores de milhares. length (1-2).

			multa: 0
			Taxa de multa por atraso. Casas decimais devem ser separadas por ponto, máximo de 2 casas decimais, não enviar caracteres diferentes de número ou ponto. Não usar separadores de milhares. Exemplo: 0.98

			desconto
			Valor do desconto por pontualidade, em Reais. Casas decimais devem ser separadas por ponto, máximo de 2 casas decimais, não enviar caracteres diferentes de número ou ponto. Não usar separadores de milhares. Exemplo: 9.58

			nome_cliente: Cliente de Exemplo
			Nome completo do pagador. length (3-80).

			cpf_cliente: 62936576000112
			CPF ou CNPJ do pagador. Por enquanto não é obrigatório, porém por determinação da Febraban será obrigatório em breve. length (11, 14)

			endereco_cliente: Rua Joaquim Vilac
			Endereço do pagador. length (3-80).

			numero_cliente: 509
			Número do endereço do pagador. length (1-10).

			complemento_cliente :
			Opcionalmente adicione o complemento do endereço do pagador. length (0-80).

			bairro_cliente: Vila Teixeira
			Bairro do endereço do pagador. length (3-80).

			cidade_cliente: Campinas
			Cidade do endereço do pagador. length (3-80).

			estado_cliente: SP
			Estado do endereço do pagador, com 2 caracteres. Exemplo: SP

			cep_cliente: 13301510
			CEP do endereço do pagador. Apenas números. length (8-10).

			logo_url: https://www.belfasttelegraph.co.uk/migration_catalog/article28851906.ece/ALTERNATES/h342/Showbiz%208-1.jpg
			URL do logo da empresa. Será cacheado de forma agressiva, portanto, para mudar o logo altere a url. Essa imagem deve ser PNG, GIF ou JPG. Os tamanhos ideais para envio são 120x80 ou 80x80. length (264).

			texto: Texto opcional
			Texto que ficará no topo dos boletos. Será impresso com fonte fixa. length (0-528)

			grupoBoletos: 001
			Identificação do grupo. É uma string que identifica um grupo de boletos. Quando um valor é passado neste campo, é retornado um link adicional para impressão de todos os boletos do mesmo grupo de uma vez. Recomendado para imprimir carnês. length (0, 60).

			pedido_numero: 89724
			Numero do pedido da cobrança. Este número é importante se você precisar editar o boleto sem necessidade de duplica-lo. O sistema não vai gerar outro boleto se o número do pedido existir. Importante: para relacionar os boletos pagos não use o pedido e sim o campo “nosso número”, que será retornado nesta requisição. ( Obrigatório em caso de alterações de dados da cobrança). length (0-20).

			webhook: http://example.com.br
			Opcionalmente informe uma URL de Webhook. Iremos chamá-la com as novas informações sempre que a cobrança for atualizada.

			especie_documento: DS
			Opcionalmente informa a espécie do titulo da cobrança.
		*/

		
		$data_send = [
			'nome_empresa' => "Batata",
			'conta_repasse' => '99999-9',
			'agencia_repasse' => '0001',
			'banco_repasse' => '033',
			'cnpj' => '00659351000109',
			'ddd' => '41',
			'telefone' => '400096830',
			'email' => ['contato@contato.com.br'],
			'agencia' => ''
		];

		$client = new GuzzleHttp\Client(['base_uri' => $this->url]);
		$response = $client->request('POST', 'recebimentos', ['form_params' => $data_send]);
		$body = $response->getBody();
		// Implicitly cast the body to a string and echo it
		var_dump( json_decode($body));

		var_dump($response);
	}
    
}

?>