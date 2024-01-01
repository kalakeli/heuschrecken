@extends('layouts.app')

@section('title', 'Datenschutzerklärung')

@section('content')
<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h1>Datenschutzerklärung</h1>
        <h6>- <?php echo date("d.m.Y") ?>- </h6>
        <p>Schön, dass Sie da sind und sich über unseren Datenschutz
        informieren möchten. Der Schutz Ihrer Privatsphäre ist uns sehr wichtig.
        Mit dieser Datenschutzerklärung möchten wir Sie über unseren Umgang mit Ihren Daten informieren
        und erläutern, welche Daten wann und wie gespeichert werden und wie wir
        gewährleisten, dass sie vertraulich bleiben und geschützt sind.</p>
        <p>Naturgemäß sind solche Texte etwas dröge, aber nicht minder wichtig.</p>

        <h2>I. Wer ist verantwortlich und wie kann ich den Datenschutzbeauftragten erreichen?</h2>
        <p>Der Verantwortliche im Sinne der DSGVO ist ... </p>
        <!-- <p><strong>Dachverband Deutscher Avifaunisten e.V.</strong> <br>
           An den Speichern 6, D-48157 Münster</p>
        <p>Vereinsregister:  Münster, Nr. 5174, <br>USt-ID-Nr.: DE263129470 </p>
        <p>Der DDA wird vertreten durch </p>
        <ul class="ddaList">
          <li>den Vorsitzenden Dr. Christoph Sudfeldt</li>
          <li>den stellvertrenden Vorsitzenden Dr. Johannes Wahl und Dr. Jakob Katzenberger</li>
        </ul> -->
        <h4>Sie haben Fragen zum Datenschutz?</h4>
        <p>Schicken Sie uns gerne eine E-Mail an
          ...
        </p>


        <h2>II. Ihre Rechte als Betroffene*r</h2>
        <p>Sie haben jederzeit folgende Rechte: </p>
        <ul class="ddaList">
          <li>Recht auf Auskunft (<a href="http://dsgvo-gesetz.de/art-15-dsgvo/" target="_blank">Art. 15 DSGVO</a>)</li>
          <li>Recht auf Berichtigung von unrichtigen Daten (<a href="http://dsgvo-gesetz.de/art-16-dsgvo/" target="_blank">Art. 16 DSGVO</a>)</li>
          <li>Recht auf Löschung bzw. ein Recht auf &bdquo;Vergessenwerden&ldquo; (<a href="http://dsgvo-gesetz.de/art-17-dsgvo/" target="_blank">Art. 17 DSGVO</a>)</li>
          <li>Recht auf Einschränkung der Verarbeitung personenbezogener Daten (<a href="http://dsgvo-gesetz.de/art-18-dsgvo/" target="_blank">Art. 18 DSGVO</a>)</li>
          <li>Recht auf Datenübertragbarkeit (<a href="http://dsgvo-gesetz.de/art-20-dsgvo/" target="_blank">Art. 20 DSGVO</a>)</li>
        </ul>
        <p>Ihnen steht als betroffener Person jederzeit ein allgemeines
          Widerspruchsrecht zu (<a href="http://dsgvo-gesetz.de/art-21-dsgvo/" target="_blank">Art. 21 DSGVO</a>).
          Der Verarbeitung von personenbezogenen Daten für Zwecke der Werbung
          einschließlich einer Analyse von Kundendaten für Werbezwecke können Sie
          jederzeit ohne Angabe von Gründen widersprechen. Ansonsten ist der
          Widerspruch gegen eine Datenverarbeitung zu begründen. Sofern die
          Datenverarbeitung auf Grundlage einer Einwilligung erfolgt, kann Ihre
          Einwilligung jederzeit mit Wirkung für die Zukunft widerrufen werden. </p>
        <p>Sie haben das Recht zur Beschwerde bei der für Sie zuständigen
          Datenschutzaufsichtsbehörde, aber einfacher ist es, sich mit uns über die
          im Impressum angegebenen Kontaktdaten in Verbindung zu setzen.</p>


        <h2>III. Verarbeitung personenbezogener Daten </h2>
        <p>Nachfolgend geben wir Ihnen einen Überblick, wie wir den Schutz Ihrer
          personenbezogenen Daten bei Zugriff auf unsere Website gewährleisten
          und welche Arten von personenbezogenen Daten wir zu welchen Zwecken und
          in welchem Umfang verarbeiten.</p>

        <h3>Verarbeitung von Daten bei Zugriff auf unserer Website</h3>
        <p>Die Webseiten sind auch nutzbar, ohne Cookies akzeptieren zu müssen
          und ohne angemeldet zu sein. Dennoch speichert der Webserver allgemeine
          Zugriffsdaten in Form sogenannter Log-Files.
          Das sind Daten etwa wie die Art des Webbrowsers, das verwendete
          Betriebssystem, den Domainnamen Ihres Internet Service Providers, die
          IP-Adresse, von der aus Sie die Webseiten aufrufen und
          Ähnliches. Diese Daten werden bei Nutzung des Internets stets übertragen
          und es sind Informationen,
          die technisch notwendig sind, um Inhalte korrekt laden zu können. </p>
        <p>Die anfallenden Logfile-Daten werden von uns über einen Zeitraum von
          drei Monaten gespeichert, um etwaige Angriffe gegen unsere Website erkennen
          und analysieren zu können. Rechtsgrundlage für die Speicherung
          <a href="http://dsgvo-gesetz.de/art-6-dsgvo/" target="_blank">Art. 6 DSGVO</a>.</p>

        <h3>Gewährleistung der Datensicherheit</h3>
        <p>Wir treffen technische und betriebliche Sicherheitsvorkehrungen, um
          bei uns gespeicherte personenbezogenen Daten vor einem Zugriff durch Dritte,
          einem Verlust oder Missbrauch zu schützen und einen gesicherten Datentransfer zu ermöglichen.</p>
        <p>Alle Online-Formulare werden über eine sichere SSL-Verbindung
          aufgerufen und Ihre Daten darüber übermittelt. Sie erkennen dies an
          einem geschlossenen Schloss in der Statusleiste Ihres Browsers. Ihre
          Daten sind auf dem Weg von Ihrem Rechner zu uns verschlüsselt.
          Wir benutzen ein Sicherheitszertifikat der Firma Let's Encrypt für die
          Verschlüsselung unseres Angebotes. </p>

        <h3>Gewährleistung der Datensicherheit auf Ihrer Seite</h3>
        <p>Wir möchten Sie darauf hinweisen, dass es aufgrund der Struktur des
          Internets zu einem ungewollten Zugriff durch Dritte kommen kann.
          Es liegt daher auch in Ihrem Verantwortungsbereich, Ihre Daten durch
          Verschlüsselung, durch Einsatz eines VPN oder in sonstiger Weise gegen
          Missbrauch zu schützen. Ohne entsprechende Schutzmaßnahmen können
          insbesondere unverschlüsselt übertragene Daten von Dritten mitgelesen werden.
          Dies betrifft auch E-Mails.
        </p>


        <h2>IV. Einbindung von Angeboten fremder Dienste </h2>
        <p>Unsere Webseiten verwenden einige Angebote fremder Dienste, um Ihnen
        die Interaktion zu erleichtern und uns eine Möglichkeit zu bieten, unseren
        Webauftritt zu verbessern. Nachfolgend erhalten Sie einen Überblick über
        die eingesetzten fremden Angebote.</p>

        <h3>Einbindung von Google Fonts</h3>
        <p>
          Diese Webseite setzt keine über die Google Fonts API eingebundenen Schriften ein.
          Alle Schriften, die nicht dem Standard entsprechen, werden direkt von 
          unserem Server eingebunden. 
        </p>

        <!-- <h3>Einbindung von Social-Plugins</h3> -->
        <!-- <p class="alert alert-warning">fehlt</p> -->
        <h3>Einbindung von Google Maps</h3>
        <p>Auf dieser Website nutzen wir das Angebot von Google Maps der Firma Google, Inc.
          mit dem Zweck, Ihnen interaktive Karten direkt in der Webseite anzeigen
          zu können, um eingebundene Kartenfunktionen komfortabel nutzen zu können.
        </p>
        <p>Diese Anwendung wird direkt von Servern der Firma Google abgerufen, so
          dass das Unternehmen die Ihnen aktuell zugewiesene IP-Adresse erhält.
          Durch den Besuch auf der Webseite erhält Google die Information, dass
          Sie die entsprechende Unterseite unserer Webseite aufgerufen haben. Ob
          und in welchem Umfang bzw. über welchen Zeitraum die IP-Adresse von
          Google gespeichert und genutzt wird, entzieht sich unserer Kenntnis.
          Rechtsgrundlage für die Einbindung dieses Dienstes ist die Aufwertung
          unseres Internetangebotes im Sinne des Art. 6 Abs. 1 S. 1 lit. f DSGVO. </p>
        <p>Sofern Sie bei einem Dienst von Google registriert sind, kann Google
          den Besuch Ihrem Account zuordnen. Selbst, wenn Sie nicht bei Google
          registriert sind bzw. sich nicht eingeloggt haben, besteht die Möglichkeit,
          dass Google Ihre IP-Adresse speichert und für die Profilbildung nutzt.
          Google speichert die über Sie erhobenen Daten als Nutzungsprofile und
          nutzt diese für Zwecke der Werbung, Marktforschung und/oder bedarfsgerechten
          Gestaltung ihrer Webseiten. Eine solche Auswertung erfolgt insbesondere
          (auch für nicht eingeloggte Nutzer) zur Darstellung von bedarfsgerechter
          Werbung und um andere Nutzer des sozialen Netzwerks über Ihre Aktivitäten
          auf unseren Webseiten zu informieren. Ihnen steht ein Widerspruchsrecht
          gegen die Bildung dieser Nutzerprofile bei Google zu.</p>
        <p>Wir weisen Sie darauf hin, dass eine Datenverarbeitung durch Google
          auch außerhalb Europas erfolgen kann, bspw. verarbeitet Google
          personenbezogene Daten auch in den USA. Google hat sich dem
          <a href="https://www.privacyshield.gov/EU-US-Framework" target="_blank">
            EU-US Privacy Shield
          </a>
          unterworfen. Google bietet ausführliche
         <a href="https://policies.google.com/privacy?hl=de&gl=de" target="_blank">
           Informationen zum Datenschutz bei Google
         </a> an.</p>

        <h3>Einbindung von OpenStreetMap</h3>
        <p>Neben dem Einsatz von Google Maps setzen wir ebenso zur Aufwertung unseres Online-Angebots
        im Sinne von Art. 6 Abs. 1 S. 1 lit. f DSGVO auch interaktive Karten ein,
        die durch <a href="https://www.openstreetmap.de/" target="_blank">OpenStreetMap</a>
        zur Verfügung gestellt werden. Unsere Programmierungen in den Karten
        erfolgen mit Hilfe der Javascript-Bibliothek
        <a href="https://leafletjs.com/" target="_blank">Leaflet</a>.
        Für die korrekte Darstellung ist es aus technischer Sicht notwendig, Anfragen
        an andere Server zu stellen. Durch diese Anfragen wäre es grundsätzlich
        möglich, dass Informationen über Ihre Benutzung dieser Website an andere
        Server übertragen und dort gespeichert werden. Die anderen Server sind
        maps.wikimedia.org (Kartenlayer) und unpkg.com (Leaflet-Dateien).
      </p>
      <p>Sie haben die Möglichkeit, den Service von OpenStreetMap zu deaktivieren
        und somit den Datentransfer an Dritte zu verhindern, indem Sie JavaScript
        in Ihrem Browser deaktivieren. Wir möchten jedoch darauf hinweisen, dass
        Sie in diesem Fall die Kartenanzeige auf unseren Seiten nicht oder nur
        eingeschränkt nutzen können.
        </p>
        <!-- <h3>Einbindung von YouTube</h3>
        <p class="alert alert-warning">fehlt</p> -->

      <h2>V. Unser Umgang mit Cookies</h2>
      <p>Unsere Website verwendet sogenannte Cookies. Cookies sind kleine Textdateien,
        die auf Ihrem Endgerät abgelegt und in Ihrem Browser gespeichert werden. Sie
        dienen dazu, unsere Angebote nutzerfreundlicher, effektiver und sicherer
        zu machen. Wir verwenden neben temporären Cookies, die mit dem Schließen
        Ihres Browsers automatisch gelöscht werden (&bdquo;Session Cookies&ldquo;)
        auch persistente Cookies, die zu einem im Cookie festgelegten Zeitraum
        gelöscht werden. </p>
      <p>Sie können selber entscheiden, ob Sie das Setzen von Cookies zulassen möchten.
        Änderungen können Sie in Ihren Browsereinstellungen vornehmen. Zum Beispiel
        (falls die Links nicht mehr aktuell sind, lassen Sie es uns bitte wissen):
      </p>
      <ul class="ddaList">
        <li><a href="https://support.google.com/accounts/answer/61416?co=GENIE.Platform%3DDesktop&hl=de&oco=1" target="_blank">Cookies in Chrome verwalten</a> </li>
        <li><a href="https://support.mozilla.org/de/kb/cookies-erlauben-und-ablehnen" target="_blank">Cookies in Firefox verwalten</a> </li>
        <li><a href="http://techmixx.de/microsoft-edge-cookies-aktivieren-oder-deaktivieren/" target="_blank">Cookies in Microsoft Edge verwalten</a> </li>
        <li><a href="https://help.opera.com/de/latest/web-preferences/" target="_blank">Webpräferenzen und Cookies in Opera verwalten</a> </li>
        <li><a href="https://support.apple.com/de-de/guide/safari/sfri11471/mac" target="_blank">Cookies in Safari verwalten</a> </li>
      </ul>
      <p>Sie haben grundsätzlich die Wahl, ob Sie alle Cookies akzeptieren, beim
        Setzen von Cookies informiert werden oder alle Cookies ablehnen wollen.
        Lehnen Sie alle Cookies ab, ist es möglich, dass Sie unser Angebot nicht
        vollständig nutzen können. </p>
      <p>Wir unterscheiden beim DDA zwischen zwei Kategorien von Cookies, den für
      die Nutzung zwingend erforderlichen und den Cookies, die weitergehende
      Zwecke erfüllen.</p>

      <h3>Zwingend erforderliche Cookies</h3>
      <p>Zwingend erforderlich für die Nutzung unserer Seiten sind die sogenannten
      Session-Cookies. Sie werden gelöscht, wenn Sie den Browser schließen. Sie
      helfen uns, Sie wiederzuerkennen, während Sie die Seiten im Rahmen einer
      einzelnen Session besuchen. Diese Session-Cookies tragen zur sicheren Nutzung
      unseres Angebots bei und werden eingesetzt für Warenkörbe, Anmeldungen, etc.</p>

      <h3>Cookies mit Ihrer Einwilligung</h3>
      <p>Neben den Session-Cookies setzen wir Cookies ein, zu deren Nutzung Sie uns
      zu Beginn der Sitzung die Erlaubnis erteilt haben. Das kann bspw. sein, um
      Anmeldedaten über das Ende einer Sitzung hinaus zu speichern. Es können auch
      Cookies zur Erfassung des Nutzungsverhaltens unserer Website sein, deren
      Tracking Sie durch Opt-Out-Möglichkeiten entgegnen können. Nachfolgend sehen
      Sie eine Übersicht dieser Cookies.</p>


      <h4>Tracking durch Matomo</h4>
      <p>Wir verwenden auf unseren Internetseiten das Webanalyse-Tool Matomo, um 
        mehr über die Nutzung der Seiten zu erfahren und um die Seiten zu verbessern.
      Das Analysetool wird vom DDA auf einem eigenen Server betrieben, ein Datenverkehr
      nach außen ist ausgeschlossen.
      In der von uns verwendeten Variante arbeitet Matomo mit einer Anonymisierung
      von IP-Adressen. Dabei werden die IP-Adressen vor einer etwaigen Nutzung
      für die Analyse des Nutzungsverhaltens gekürzt. Ein Personenbezug aus der
      IP-Adresse ist nicht möglich.
    </p>
    <p>Ihre IP-Adresse wird nur in der verkürzten Form zur Durchführung einer
      groben Geolokalisierung genutzt. Hier wird ihr Herkunftsland und auch Ihr
      Access-Provider (&bdquo;Internetzugangsprovider&ldquo;) ermittelt und gespeichert.
    </p>

    <p>Das Analyse-Tool Matomo funktioniert durch das Setzen eines Cookies, das
      über das Ende Ihres Besuches hinaus als persistenter Cookie (mit einer Laufzeit
      von zwei Wochen) als kleine Textdatei auf Ihrem Endgerät gespeichert wird.
      Dieses Cookie ermöglicht nicht nur das Wiedererkennen von Benutzer*innen,
      sondern auch die nichtpersonenbezogene Analyse des Verhaltens von Besucher*innen
      auf der Website. Rechtsgrundlage für die Speicherung des Cookies ist die
      erteilte Einwilligung (Art. 6 Abs. 1 S. 1 lit. a DSGVO).
    </p>
    <h5>Der Nutzung widersprechen</h5>
    <p>Sie können der Nutzung widersprechen, in dem Sie ein sogenannten &bdquo;Opt-Out-Cookie&ldquo;
    setzen. Hierzu haben Sie nachfolgend die Gelegenheit. </p>
    <div class="alert alert-light">
      <iframe style="border: 0; height: 200px; width: 807px; max-width:100% !important;" src="https://stats.bund.net/stats/index.php?module=CoreAdminHome&amp;action=optOut&amp;language=de"></iframe>
    </div>
      </div>
    </div>
  </div>
</section>

@endsection
