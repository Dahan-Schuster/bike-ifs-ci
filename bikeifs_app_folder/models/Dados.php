<?php

/**
 * CLASSE USADA APENAS PARA TESTES.
 * Possui métodos de geração automática de dados.
 * Use-os junto um controlador de inserção para
 * preencher o banco de dados com dados aletórios.
 * Use um loop for para inserir muitos dados de uma vez.
 * 
 */
class Dados {

	public static function escolherAroAleatorio()
	{
		return Dados::$aros[array_rand(array(Dados::$aros))];
	}

	public static function escolherMarcaAleatoria()
	{
		return	Dados::$marcas[array_rand(Dados::$marcas)];
	}

	public static function escolherObsAleatoria()
	{
		return Dados::$obs[array_rand(Dados::$obs)];
	}

	public static function gerarTelefoneAleatorio()
	{	
		$ddd = Dados::escolherDDDAleatorio();
		$numero = Dados::gerarNumeroAleatorio();

		return "($ddd) $numero";
	}

	public static function gerarNomeAleatorio()
	{	
		
		$nome = Dados::escolherNomeAleatorio();		
		$sobrenome = Dados::escolherSobrenomeAleatorio();
		return "$nome $sobrenome";
	}

	public static function gerarEmailComNome($nome)
	{
		$nome = Dados::pegarPrimeiroNomeMinusculo($nome);
		$servidorEmail = Dados::escolherServidorEmailAleatorio();

		return "$nome@".$servidorEmail.".com";
	}

	public static function escolherTipoAleatorio()
	{
		return array_rand(Dados::$tipos, 1);
	}

	/**
	 * ## FONTE: https://gist.github.com/acfreitas/fb7465c33156ec144513
	 *
	 * Método para gerar CPF válido, com máscara ou não
	 * @example gerarCPFAleatorio(0)
	 *          para retornar CPF sem máscara
	 * @param int $mascara
	 * @return string
	 */
	public static function gerarCPFAleatorio($mascara = "1") {
	    $n1 = rand(0, 9);
	    $n2 = rand(0, 9);
	    $n3 = rand(0, 9);
	    $n4 = rand(0, 9);
	    $n5 = rand(0, 9);
	    $n6 = rand(0, 9);
	    $n7 = rand(0, 9);
	    $n8 = rand(0, 9);
	    $n9 = rand(0, 9);
	    $d1 = $n9 * 2 + $n8 * 3 + $n7 * 4 + $n6 * 5 + $n5 * 6 + $n4 * 7 + $n3 * 8 + $n2 * 9 + $n1 * 10;
	    $d1 = 11 - (Dados::mod($d1, 11) );
	    if ($d1 >= 10) {
	        $d1 = 0;
	    }
	    $d2 = $d1 * 2 + $n9 * 3 + $n8 * 4 + $n7 * 5 + $n6 * 6 + $n5 * 7 + $n4 * 8 + $n3 * 9 + $n2 * 10 + $n1 * 11;
	    $d2 = 11 - (Dados::mod($d2, 11) );
	    if ($d2 >= 10) {
	        $d2 = 0;
	    }
	    $retorno = '';
	    if ($mascara == 1) {
	        $retorno = '' . $n1 . $n2 . $n3 . "." . $n4 . $n5 . $n6 . "." . $n7 . $n8 . $n9 . "-" . $d1 . $d2;
	    } else {
	        $retorno = '' . $n1 . $n2 . $n3 . $n4 . $n5 . $n6 . $n7 . $n8 . $n9 . $d1 . $d2;
	    }
	    return $retorno;
	}

	public static function gerarMatriculaAleatoria() {
		return rand(2000, 2019) . rand(1, 999) . str_pad(rand(1, 9999), 4, STR_PAD_LEFT);
	}

	private static $aros = array (
		'20', '24', '26', '29'
	);

	private static $marcas = array(
		'Caloi', 'Scott', 'Shimano', NULL
	);

	private static $obs = array(
		'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a.',
		'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean leo neque, facilisis non ipsum eget, imperdiet interdum augue. Mauris sit.',
		'Lorem ipsum dolor sit amet.',
		NULL 
	);

	private static $servidoresEmail = array(
		'gmail','yahoo','outlook','zoho','mail', 'iCloud' 
	);

	private static $tipos = array ('usuario', 'servidor', 'visitante');

	# DDDs de todos os estados do Brasil
	private static $DDDs = array (
		"11","12","13","14","15","16","17","18","19","21","22","24","27","28","31","32","33","34","35","37","38","41","42","43","44","45","46","47","48","49","51","53","54","55","61","62","63","64","65","66","67","68","69","71","73","74","75","77","79","81","82","83","84","85","86","87","88","89","91","92","93","94","95","96","97","98","99",);

	# Lista de sobrenomes
	private static $sobrenomes = array(
		"Adamovich","Aleksandrov","Alekseev","Aristov","Artemiev","Astakhov","Avdeev","Averin","Bachurin","Bakhmetev","Bakhtin","Balakirev","Balashov","Baranov","Baryshnikov","Basov","Baturin","Bazhenov","Bazin","Belkin","Bibikov","Bludov","Bogdanov","Bogdanovich","Bolotnikov","Bolotov","Borisov","Borodin","Bulgakov","Buturlin","Bykov","Chebotarev","Cherkasov","Chernyshev","Chertkov","Chesnokov","Chirikov","Danilov","Davydov","Dembinsky","Demidov","Denisov","Dmitriev","Dobrovolsky","Dubensky","Dubrovsky","Dunin","Durov","Efremov","Ekimov","Eliseev","Eremeev","Ermolov","Ertel","Esipov","Evreinov","Filimonov","Gagin","Galagan","Garin","Gavrilov","Gerasimov","Gladkov","Glebov","Golikov","Golovin","Goncharov","Gorchakov","Gordeev","Grigoriev","Grigorov","Grigorovich","Gubarev","Guriev","Ievlev","Ignatiev","Ilin","Ilinsky","Isakov","Ivanenko","Ivanov","Izmailov","Kalugin","Kamensky","Karpov","Kharlamov","Khlebnikov","Khomutov","Khrushchov","Kireev","Kiselev","Kniazev","Kobylin","Kochetov","Komarov","Komarovsky","Kondakov","Konovalov","Koptev","Kopylov","Korolkov","Korovkin","Koshelev","Kozhevnikov","Kozin","Kozlov","Krasnopolsky","Krivtsov","Krylov","Kuchin","Kuznetsov","Laptev","Larionov","Lavrov","Lazarev","Lebedev","Litvinov","Lobanov","Losev","Lukin","Lunin","Maikov","Makarov","Malinovsky","Mamaev","Markov","Markovich","Martynov","Mavrin","Medvedev","Merkulov","Mikhailov","Mikhalkov","Mikulin","Mishchenko","Mishin","Mitrofanov","Moiseev","Molchanov","Mukhanov","Muratov","Muraviev","Naumov","Navrotsky","Nazarov","Nestorov","Nikitin","Novikov","Novitsky","Obukhov","Ogarev","Okulov","Olenin","Orlov","Ozerov","Panin","Panov","Pavlov 2","Pavlov","Persky","Pestov","Petrov","Petrovsky","Pleshcheev","Polunin","Pozniak","Protopopov","Pushkin","Raevsky","Ragozin","Rakov","Razumovsky","Romanov","Romanovsky","Safonov","Salov","Samarin","Samsonov","Satin","Savich","Savin","Sazonov","Seletsky","Semenov","Sergeev","Shamin","Shestakov","Shevtsov","Shishkin","Shishkov","Shubin","Simonov","Sinitsyn","Skuratov","Skvortsov","Smirnov","Sokolov","Sokolovsky","Sonin","Starov","Stepanov","Stoianov","Stolypin","Strogonov","Surin","Sushkov","Suvorov","Sysoev","Tatarinov","Telegin","Teplov","Tinkov","Titov","Tokarev","Tolkachev","Tomilin","Tretiakov","Trofimov","Trotsky","Trunov","Turgenev","Urbanovich","Ushakov","Usov","Uvarov","Vaganov","Valuev","Vasiliev","Verigin","Viazemsky","Vlasov","Volkov","Voronin",	"Voronov",	"Vorontsov",	"Vronsky",	"Yablonsky",	"Yakovlev",	"Yavorsky",	"Yuriev",	"Zakharov",	"Zemlin",	"Zhukov",	"Zhuravlev",	"Zotov");

	# Lista de nomes
	private static $nomes = array (
		"Benett","Benjamin","Bennett","Bjorn","Blade","Blaine","Blair","Blake","Brian","Brooke","Bryan","Caden","Caleb","Callum","Cameron","Carter","Casey","Casper","Charles","Christian","Christopher","Cian","Cohen","Collin","Connor","Cooper","Craig","Cullen","Damien","Damon","Daniel","David","Dean","Derek","Devan","Diesel","Dilan","Dilon","Dimitri","Dirk","Dominic","Donovan","Dorian","Drew","Duncan","Dylan","Edward","Eli","Eliah","Elijah","Elliott","Emery","Emile","Emmett","Enrico","Enrique","Enzi","Enzo","Erik","Ethan","Etienne","Evan","Everett","Evert","Ezekiel","Ezra","Fabien","Fabrizio","Felipe","Felix","Ferdinand","Fergus","Fidel","Finley","Finn","Flinn","Flint","Florent","Florian","Floyd","Flynn","Forest","Frances","Francesco","Francis","Frank","Franz","Frederick","Fritz","Gabor","Gabriel","Gardner","Garett","Garner","Garrett","Gary","Gaspard","Gavin","Genaro","Geoffrey","George","Georgio","Geovanni","Germaine","Giacomo","Gian","Giancarlo","Gianluca","Gianni","Giles","Gio","Giorgi","Giorgio","Giovanni","Giulio","Giuseppe","Glenn","Gonzalo","Gordon","Graham","Grant","Gray","Grayson","Griffin","Griffith","Guillaume","Guillermo","Gustaf","Gustav","Guy","Hans","Hanson","Hardy","Harley","Harlow","Harper","Harry","Hartley","Harvey","Hayden","Heath","Hector","Heinrich","Hektor","Hendrix","Henri","Henrik","Henry","Hiro","Holden","Hudson","Hugh","Humphrey","Hunter","Iago","Ian","Ianis","Ignatius","Igor","Iker","Indigo","Ioan","Ioannis","Irving","Ivan","Jabbar","Jack","Jacob","Jake","Jamal","James","Jameson","Jamie","Jan","Janos","Jansen","Jared","Jarod","Jasper","Javier","Jax","Jay","Jayden","Jean","Jensen","Jeremy","Jerome","Jesse","Jimmy","Jing","Joachim","Joel","Joey","Johan","John","Johnny","Jonah","Jonathan","Jordan","Joseph","Josh","Joshua","Josiah","Juan","Jude","Julian","Justin","Kai","Kaiden","Kane","Keane","Keeran","Keith","Kellan","Kelley","Kian","Kingsley","Kingston","Kion","Kipp","Kiran","Kirk","Knox","Kurt","Kyle","Lane","Lars","Laurent","Lawrence","Lawson","Leif","Lennon","Lennox","Lenny","Leo","Leon","Leonardo","Leone","Levi","Levy","Lex","Li","Liam","Logan","London","Lorenzo","Lou","Louie","Louis","Luan","Lucas","Lucca","Lucian","Luigi","Luka","Luke","Maddox","Magnus","Marc","Marcel","Mark","Marlow","Martin","Mason","Mateo","Mathew","Mathias","Mathieu","Matt","Matti","Mattia","Max","Maximus","Maxwell","Meredith","Meyer","Micah","Michael","Michel","Mickey","Miles","Milo","Ming","Monroe","Morgan","Moses","Murphy","Nathan","Nicholas","Nicholaus","Nico","Nicola","Nicolas","Noah","Noel","Nolan","Norman","Oakley","Ocean","Octavius","Odin","Olaf","Oleg","Olen","Olie","Olin","Oliver","Olivier","Orion","Ottis","Otto","Owen","Pablo","Pacey","Paolo","Paris","Parker","Pascal","Pepe","Perry","Peter","Petros","Peyton","Philippe","Phineas","Phinn","Phoenix","Pierre","Piers","Pietro","Pip","Porter","Quinn","Raphael","Raven","Ravi","Reed","Reef","Reese","Remy","Rhys","Riley","River","Rocco","Romeo","Rory","Rowan","Rufus","Rupert","Russell","Ryan","Ryder","Ryland","Sacha","Salvatore","Sam","Samson","Samuel","Santino","Sawyer","Scott","Seamus","Sean","Sebastian","Seth","Seymour","Simon","Skye","Skylar","Soren","Spencer","Stan","Stefan","Stefano","Stephen","Steven","Tate","Tatum","Taylor","Teo","Theo","Theodore","Thierry","Thomas","Thor","Tim","Tobey","Tobiah","Toby","Todd","Tom","Tracey","Travis","Trent","Trevor","Trey","Tripp","Tristan","Troy","Tucker","Tyler","Valentine","Vaughn","Viggo","Viktor","Vince","Vincent","Vincenzo","Webb","Wei","Willam","Winter","Wren","Xander","Xane","Xavi","Xin","Yanis","Yannick","Yoan","Yoav","Zach","Zeke","Zeus","Zion",	);

	private static function pegarPrimeiroNomeMinusculo($nome)
	{
		return mb_strtolower(preg_split('/\s/', $nome)[0]);
	}

	private static function escolherDDDAleatorio()
	{
		$index = array_rand(Dados::$DDDs, 1);
		return Dados::$DDDs[$index];
	}

	private static function gerarNumeroAleatorio ()
	{
		$parte1 = '9' . rand(1000, 9999);
		$parte2 = rand(1000, 9999);

		return "$parte1-$parte2";
	}

	private static function escolherNomeAleatorio()
	{
		$index = array_rand(Dados::$nomes, 1);
		return Dados::$nomes[$index];
	}

	private static function escolherSobrenomeAleatorio()
	{
		$index = array_rand(Dados::$sobrenomes, 1);
		return Dados::$sobrenomes[$index];
	}

	private static function escolherServidorEmailAleatorio()
	{
		$index = array_rand(Dados::$servidoresEmail, 1);
		return Dados::$servidoresEmail[$index];
	}

	private static function mod($dividendo, $divisor) {
	    return round($dividendo - (floor($dividendo / $divisor) * $divisor));
	}
}