<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta name="description" content="Чеченско-русский и русско-чеченский онлайн словарь"> 
	<meta name="keywords" content="чеченский язык, русско чеченский, чеченский перевод, чеченский переводчик, чеченские слова, чеченский онлайн, чеченский переводчик онлайн, русско чеченский переводчик, чеченский переводчик онлайн, русско чеченский переводчик, чеченско русский словарь, русско чеченский словарь, чеченско-русский словарь, русско-чеченский словарь, онлайн словарь, чеченско-русский, чеченско-русский и русско-чеченский словарь"> 
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/dosh.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"/>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
	<title>ДикДошам - нохчийн-оьрсийн, оьрсийн-нохчийн онлайн дошам</title>
</head>
<body>

<div id="dosh_block">
    <div id="lang_block">
    	<a href="ru/">
    		<img src="images/ru.png" width="26">
    		<span>Русский</span>
    	</a>
    </div>
	<header>
		<a href=javascript:void(0) id="logo" title="Коьрта агӀо схьайелла" ></a>
		<h1>
			<span id="dosham">
				<a href=javascript:void(0)  title="Коьрта агӀо схьайелла">ДикДошам</a>
			</span><br>
			<span>
				<nobr>Нохчийн-оьрсийн,</nobr> <nobr>оьрсийн-нохчийн</nobr> онлайн дошам
			</span>
		</h1>
	</header>
	<div id="dosh_form">
		<input type="text" name="word" id="word" placeholder="Гочдан деза дош чу а йаздай, пиллиг Enter (Ввод) тӀетаӀайе..." />
		<button id="translate_btn"  title="Гочдайта тӀетаӀаде">Гочдан</button>
	</div>
	<div id="errors-block"></div>
	
	<div id="result"></div>
    <div id="dosham_info">
        <h1 align="center">Марша догӀийла ДикДошаме</h1>
		<p class="opis"><b>ДикДошам</b> нохчийн-оьрсийн, оьрсийн-нохчийн онлайн дошам ю.<br /><br />
			Дошам хӀокху белхийн буха тӀехь хӀоттийна йу:
			<ol>
				<li><nobr>Мациев А.Г.</nobr> <nobr>Нохчийн-оьрсийн</nobr> дошам.</li>
				<li><nobr>Карасаев А.Т.,</nobr> <nobr>Мациев А.Г.</nobr> <nobr>Оьрсийн-нохчийн </nobr> дошам.</li>
				<li><nobr>Умархаджиев С.М.,</nobr> <nobr>Ахматукаев А.А.</nobr> <nobr>Нохчийн-оьрсийн,</nobr> <nobr>оьрсийн-нохчийн</nobr> математикин терминийн дошам.</li>
				<li><nobr>Абдурашидов Э.Д.</nobr> <nobr>Нохчийн-оьрсийн,</nobr> <nobr>оьрсийн-нохчийн</nobr> йуридически терминийн дошам.</li>
				<li><nobr>Берсанов Р.У.</nobr> <nobr>Нохчийн-оьрсийн,</nobr> оьрсийн-нохчийн адаман анатомин дошам.</li>
				<li><nobr>Умархаджиев С.М.,</nobr> <nobr>Асхабов Х.И.,</nobr> <nobr>Бадаева А.С.,</nobr> <nobr>Вагапов Ӏ.Д.,</nobr> <nobr>Израилова Э.С.,</nobr> <nobr>Султанов З.А.,</nobr> <nobr>Астемиров А.В.</nobr>  <nobr>Оьрсийн-нохчийн,</nobr> <nobr>нохчийн-оьрсийн</nobr> компьютерийн лексикин дошам.</li>
				<li><nobr>Байсултанов Д.Б.</nobr> <nobr>Нохчийн-оьрсийн</nobr> дошам ("А. Мациевн (1961 ш.) "Нохчийн-оьрсийн дошам" юкъа ца яаханчу лексемех хӀоттийна йолу нохчийн меттан дескриптивни дошам").</li>
				<li><nobr>Исмаилов А.</nobr> <nobr>Нохчийн-оьрсийн,</nobr> оьрсийн-нохчийн дошам ("Дош" книги тӏера).</li>
				<li><nobr>Аслаханов С-А.М.</nobr> <nobr>Оьрсийн-нохчийн</nobr> спортивни терминийн а, дешнийн  цхьаьнакхетарийн а дошам.</li>
			</ol>
		</p>
    </div>
</div>

<footer>
	<div class="footer-block">
		<span class="copy">&#xa9; <?php echo date ('Y'); ?> г.</span>
		<span class="footer-txt"> НОХЧИЙН РЕСПУБЛИКИН ӀИЛМАНИЙН АКАДЕМИ. ПАЙДЕ СЕМИОТИКИН ОТДЕЛ.</span>
	</div> 
</footer>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(73293931, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/73293931" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</body>
</html>
