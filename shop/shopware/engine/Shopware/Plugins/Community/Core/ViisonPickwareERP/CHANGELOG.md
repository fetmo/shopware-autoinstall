## 3.2.51

### en

* Fixes a bug in the calculation of the gross purchase amount in the gross profit report.
* Fixes a bug in the plugin's uninstallation process in Shopware 5.3.

### de

* Behebt einen Fehler in der Berechnung des Brutto-Wareneinkauf-Werts in der Auswertung "Rohertrag".
* Behebt einen Fehler bei der Deinstallation des Plugins in Shopware 5.3.


## 3.2.50

### en

* Improves the English translation of the plugin configuration.
* Fixes the pagination of the gross profit report.

### de

* Verbessert die Englische Übersetzung der Pluginkonfiguration.
* Behebt einen Fehler in der seitenweisen Anzeige der Ergebnismenge in der Auswertung "Rohertrag".
 

## 3.2.49

### en

* Fixes an error that occurred when opening the article edit window.

### de

* Behebt einen Fehler, der beim Öffnen des Artikeldetailfensters auftrat.


## 3.2.48

### en

* Fixes an error that occurred when opening the article edit window.

### de

* Behebt einen Fehler, der beim Öffnen des Artikeldetailfensters auftrat.


## 3.2.47

### en

* Improves the UI of the stock overview.
* Improves the performance of the supplier order management.

### de

* Verbessert die Darstellung der Bestandsübersicht.
* Verbessert die Geschwindigkeit des Lieferantenbestellwesens.


## 3.2.46

### en

* Adds an English translation for the plugin configuration.
* Fixes a problem that prevented supplier orders from being created successfully.

### de

* Fügt Englische Übersetzungen der Pluginkonfiguration hinzu.
* Behebt ein Problem bei der Erstellung von Lieferantenbestellungen.


## 3.2.45

### en

* Fixes an error that appeared when opening the supplier management view.
* Removes minimum stock values from articles that are not stock-managed.

### de

* Behebt einen Fehler beim Öffnen des Lieferantenbestellwesens.
* Entfernt die Lager-Mindestbestände von Artikeln, die nicht bestandsgeführt sind.


## 3.2.44

### en

* Fixes a bug in the sorting of the supplier article number column of the article assignment view within the supplier management window.

### de

* Behebt einen Fehler in der Sortierung der Spalte "Lieferanten Artikel-Nr." im Tab "Artikelzuordnung" des "Lieferanten bearbeiten" Fensters.


## 3.2.43

### en

**Attention:** This release is incompatible with Pickware Mobile versions prior to 1.1.42. Users of Pickware Mobile must update it to the newest version after installing this update.

* Now supports individual article numbers per supplier.
* Adds missing thumbnail quality settings to supplier order media album.
* Improves compatibility with Pickware POS.

### de

**Achtung:** Diese Version ist mit Pickware Mobile-Versionen vor 1.1.42 inkompatibel. Benutzer von Pickware Mobile müssen daher nach der Installation dieses Updates ebenfalls Pickware Mobile auf die neueste Version aktualisieren.

* Unterstützt jetzt individuelle Artikelnummern je Lieferant.
* Ergänzt die fehlende Konfiguration der Thumbnail Qualität des Medien Albums zum Lieferantenbestellwesen.
* Verbessert die Kompatibilität mit Pickware POS.


## 3.2.42

### en

* Fixes several UI bugs in the backend extensions.

### de

* Behebt einige Anzeigefehler in den Backend-Erweiterungen.


## 3.2.41

### en

* Improves marking articles as "not stock managed" via the REST API.

### de

* Verbessert das Markieren eines Artikels als "nicht bestandsgeführt" über die REST API.


## 3.2.40

### en

* It is now possible to mark an article or variant as "not stock managed" via the REST API by changing the `viisonNotRelevantForStockManager` attribute.

### de

* Es ist nun möglich durch Ändern des `viisonNotRelevantForStockManager` Attributs über die REST API einen Artikel bzw. eine Variante als "nicht bestandsgeführt" zu markieren.


## 3.2.39

### en

* Fixes a Smarty caching error that occurred when opening the shopware backend

### de

* Behebt einen Fehler im Zusammenhang mit Caching in Smarty, der beim Öffnen des shopware Backends auftrat


## 3.2.38

### en

* Improves the stock initialization.

### de

* Verbessert die Bestandsinitialisierung.


## 3.2.37

### en

* Improves the usability of the (partial-)cancellation dialog of the order detail window.
* Adds the option to add a "dummy" positon, when canceling order positions via the (partial-)cancellation dialog of the order detail window.
* Adds a new column "tax" to the (partial-)cancellation dialog of the order detail window.

### de

* Verbessert die Darstellung und Usability des (Teil-)Storno-Dialogs des Bestell-Detail Fensters.
* Erlaubt das Hinzufügen einer "Dummy" Position beim Stornieren von Bestellpositionen mittels des (Teil-)Storno-Dialogs des Bestell-Detail Fensters.
* Fügt dem (Teil-)Storno-Dialog des Bestell-Detail Fensters eine neue Spalte "Steuer" hinzu.


## 3.2.36

### en

* Fixes several UI bugs in the backend extensions.

### de

* Behebt einige Anzeigefehler in den Backend-Erweiterungen.


## 3.2.35

### en

* When editing the available stock it is now saved right away
* Improves the cancellation of order positions so that the window is not closed and reopened anymore
* Fixes the editing of purchase prices in the article stock history
* Fixes a UI glitch in the supplier order creation/editing
* Contains preparations for Pickware Mobile v1.1.27

### de

* Nach dem Bearbeiten des verfügbaren Lagerbestandes wird dieser nun direkt gespeichert
* Verbessert die Stornierung von Bestellposition, sodass das Fenster nicht mehr geschlossen und erneut geöffnet wird
* Behebt einen Fehler der das Bearbeiten von Einkaufspreisen in der Artikelbestandshistory verhinderte
* Behebt einen Darstellungsfehler im Lieferantenbestellwesen
* Enthält Vorbereitungen auf Pickware Mobile v1.1.27


## 3.2.34

### en

* Prevents potential errors in the stock caused by a CSV import after the stock of the imported article has already been initialized.
* Fixes a bug that occurred when loading the stock list in the backend articles module.
* Fixes a bug that might have resulted in an empty order list in the backend articles module.

### de

* Verhindert mögliche Bestandsfehler durch den CSV-Import, nachdem der Bestand des importierten Artikels bereits initialisiert wurde.
* Behebt einen Fehler, der beim Laden der Bestandsliste im Artikel auftrat.
* Behebt einen Fehler, der unter Umständen dazu führte, dass die Liste der Bestellungen eines Artikels nicht geladen wurde.


## 3.2.33

### en

* Fixes an error that was causing wrong results in the rated stock view in some cases.
* Improves performance when loading the list of supplier orders.
* Stock is now automatically initialized after importing articles and article variants from CSV.
* Stock is now automatically initialized after creating articles and article variants over the REST API.
* Fixes a number of issues which may have caused stock errors when generating article variants.

### de

* Behebt die Ursache für in einigen Situationen auftretende falsche Werte im bewerteten Warenbestand.
* Verbessert die Geschwindigkeit beim Laden der Lieferantenbestellungen.
* Beim CSV-Import von Artikeln und Varianten werden die Bestände nun automatisch initialisiert.
* Beim Erstellen von Artikel und Varianten über die REST API werden die Bestände nun automatisch initialisiert.
* Behebt mehrere Fehler beim Generieren von Varianten, die zu falschen Beständen führen konnten.


## 3.2.32

### en

* Fixes an error that might have occurred while reserving stock
* Fixes an error during the plugin update occurring in some MySQL versions

### de

* Behebt einen Fehler der unter Umständen beim Reservieren von Beständen auftrat
* Behebt einen Fehler der unter manchen MySQL Versionen während des Updates auftrat


## 3.2.31

### en

* When changing the order status or an order item's shipped value in the backend, it is now possible to choose the warehouse, whose stock will be changed by cancelling/shipping the order items
* Fixes an error that might have occurred while reserving stock

### de

* Ändert man den Status einer Bestellung oder die versendete Anzahl einer Bestellposition im Backend, ist es nun möglich das Lager auszuwählen, dessen Bestand durch das Stornieren/Versenden der Positionen verändert wird
* Behebt einen Fehler der unter Umständen beim Reservieren von Beständen auftrat


## 3.2.30

### en

* Fixes an error that might have occurred during the update to version 3.2.29

### de

* Behebt einen Fehler, der möglicherweise während des Updates auf Version 3.2.29 auftrat


## 3.2.29

### en

* The article names on supplier order documents are now correctly translated to the supplier's language, if available
* Improves the UI of the stock overview
* Fixes a bug that resulted in partially duplicated stocks when duplicating variants
* Fixes a bug that might have caused the email sender to be set more than once when sending documents via email

### de

* Die Artikelnamen auf Dokumente zu Lieferanten-Bestellungen werden nun korrekt in die Sprache des Lieferanten übersetzt, sofern verfügbar
* Verbessert die Darstellung in der Bestandsübersicht
* Behebt einen Fehler der dazu führte, dass beim Duplizieren von Varianten die Bestände teilweise ebenfalls kopiert wurden
* Behebt einen Fehler der unter Umständen dazu führte, dass beim Dokumentenversand per E-Mail der Absender mehrfach gesetzt wurde


## 3.2.28

### en

* Improves the performance and stability of the supplier order window
* Emails to suppliers are now translated correctly
* Adds the full article name to exports of stocks/bin locations and supplier article detail assignments ("Shopware Import/Export" plugin)
* Fixes an error that occurred when importing the stock/bin location of an article, whose stock has not been initialized before ("Shopware Import/Export" plugin)
* Fixes a bug that might have caused article's stock to be initialized more than once

### de

* Verbessert die Leistung und Stabilität des Lieferanten-Bestellwesens
* E-Mails an Lieferanten werden nun korrekt übersetzt
* Fügt den vollständigen Artikelnamen zu Exporten von Lagerbeständen/Lagerplätzen und Lieferanten-Artikel-Zuordnungen hinzu ("Shopware Import/Export" Plugin)
* Behebt einen Fehler, der beim Bestands-/ Lagerplatz-Import von Artikel auftrat, deren Bestand vorher nicht initialisiert wurde ("Shopware Import/Export" Plugin)
* Behebt einen Fehler, der unter Umständen dazu führte, dass der Bestand des gleichen Artikels mehrmals initialisiert wurde


## 3.2.27

### en

* Enables usage of HTML email templates in supplier orders.
* Fixes a bug related to assigning outgoing stock entries to initialization stock entries.
* Fixes an out-of-memory issue that occurs during large rated stock exports.

### de

* Unterstützt HTML E-Mail-Templates in Lieferanten-Bestellungen.
* Behebt ein Problem bei der Verknüpfung von ausgehenden Bestandseinträgen mit Initialisierungseinträgen.
* Behebt ein Out-of-Memory-Problem beim Export des bewerteten Warenbestands.


## 3.2.26

### en

* Provide usage of html email templates as well as custom sender name and address

### de

* Verwende HTML E-Mail Templates, sowie individuelle Senderinformationen, sofern konfiguriert


## 3.2.25

### en

* Adds a plugin compatibility warning
* The amount of entries on list dialogs is now configurable

### de

* Fügt eine Plugin-Kompatibilitätswarnung hinzu
* Die Anzahl der Einträge für Listen-Dialoge ist jetzt konfigurierbar


## 3.2.24

### en

* Fixes a bug in the stock overview that caused many articles to be marked as problems, although their stocks were correct

### de

* Behebt einen Fehler in der Bestandsübersicht, der dazu führte, dass einige Artikel als Probleme markiert wurden, obwohl ihre Bestände korrekt waren


## 3.2.23

### en

* Fixes a bug in the supplier order document causing positions to be hidden, if a custom position limit is configured
* Fixes a bug in the order cancellation, which caused the whole order to be cancelled, if only shipping costs should have been cancelled

### de

* Behebt einen Fehler im Lieferantenbestellungs-Dokument, der dazu führte, dass manche Positions nicht angezeigt wurden, wenn ein spezielles Positionen-Limit konfiguriert ist
* Behebt einen Fehler in der Stornierung von Bestellungen, der dazu führte, dass die gesamte Bestellung storniert wurde, wenn nur die Versandkosten storniert werden sollten


## 3.2.22

### en

* Fixes some display bugs in the supplier order document
* Fixes a bug in the stock overview that prevent the article list from being sorted by sales

### de

* Behebt einige Darstellungsfehler im Lieferantenbestellungs-Dokument
* Behebt einen Fehler in der Bestandsübersicht, der dazu führte, dass die Artikelliste nicht nach Verkäufen sortiert werden konnte


## 3.2.21

### en

* Improves the performance of the custom Pickware export profiles for many articles

### de

* Verbessert die Leistung beim Export mit den Pickware Profilen für viele Artikel


## 3.2.20

### en

* Improves the handling of articles that are marked as "not relvant for stock managing"
* Improves the compatibility with Pickware POS

### de

* Verbessert die Handhabung von Artikeln, die als "nicht bestandsgeführt" markiert sind
* Verbessert die Kompatiblität mit Pickware POS


## 3.2.19

### en

* Fixes an issue that prevented article main variant attributes from being copied to generated variants.
* Fixes a number of UI glitches when editing non-stock-managed articles.
* Fixes number format glitches in analytics.
* Fixes customer number in supplier order document.

### de

* Behebt einen Fehler beim Kopieren von Attributen der Artikel-Hauptvariante in neu generierte Artikelvarianten.
* Behebt einige kleine UI-Fehler bei der Bearbeitung von nicht bestandsgeführten Artikeln.
* Behebt einige falsche Zahlenformate in den Auswertungen.
* Behebt Fehler mit der Kundennummer in Lieferantenbestellungs-Dokumenten.


## 3.2.18

### en

* The fields contained in a supplier order CSV export are now configurable

### de

* Die Felder, die in einem CSV-Export einer Lieferantenbestellung enthalten sind, sind nun konfigurierbar


## 3.2.17

### en

* Fixes a problem when generating article variants on Shopware versions below 5.2.13.

### de

* Behebt einen Problem bei der Generierung von Artikelvarianten mit Shopware-Versionen unter 5.2.13.


## 3.2.16

### en

* Fixes a problem that was causing stock errors after generating article variants.

### de

* Behebt einen Problem mit fehlerhaften Beständen nach der Generierung von Artikelvarianten.


## 3.2.15

### en

* Fixes a sporadically occurring error during the plugin update

### de

* Behebt einen sporadisch auftretenden Fehler im Plugin-Update


## 3.2.14

### en

* Fixes a script error when generating article variants.

### de

* Behebt ein Javascript-Problem beim Generieren von Artikelvarianten.


## 3.2.13

### en

* Changes the article number column name in the import and export of stocks and supplier article detail assignments from "orderNumber" to "articleNumber"
* Fixes an error that occurred when loading the document template configuration

### de

* Ändert den Namen der Artikelnummer-Spalten im Im- und Export von Beständen sowie Lieferanten-Artikel-Zuordnungen von "orderNumber" zu "articleNumber"
* Behebt einen Fehler beim Laden der Dokumenten-Template Einstellungen


## 3.2.12

### en

* Hides irrelevant stock management functionality for articles that are not stock-managed
* Improves the performance when loading the stock initialization for many articles in the shop

### de

* Versteckt Bestandsfunktionen für nicht bestandsgeführte Artikel
* Verbessert die Geschwindigkeit beim Laden der Bestandsinitialisierung bei vielen Artikeln im Shop


## 3.2.11

### en

* Improves the naming of documents in email attachments
* Adds the missing variant texts to the stock initialization and analytics
* From now on the destination warehouse is displayed on the supplier order documents


### de

* Verbessert die Benennung von Dokumenten in Email-Anhängen
* Fügt den fehlenden Variantentext zur Bestandsinitialisierung und zu den Auswertungen hinzu
* Ab sofort wird das Ziellager standardmäßig auf den Dokumenten von Lieferantenbestellungen angezeigt


## 3.2.10

### en

* Makes the supplier order document template more customizable

### de

* Verbessert die Anpassbarkeit des Dokumenten-Template von Lieferantenbestellungen


## 3.2.9

### en

* Fixes a bug in the supplier order document template that caused a wrong document title

### de

* Behebt einen Fehler, der dafür sorgte, dass im Dokumenten-Template von Lieferantenbestellungen ein falscher Title angezeigt wurde


## 3.2.8

### en

* Adds the import and export of stocks, bin locations, suppliers and supplier article detail assignments (requires the "Shopware Import/Export" plugin)
* Adds a configurable document template for supplier orders
* Improves the sort order in the article stock list
* Fixes a bug that caused the stock of an article to be copied to generated variants
* Fixes a bug in the 'inStock' value update in batch processing mode
* Fixes a bug in the cancellation of shipping costs of net orders
* Fixes an error that prevented the deletion of warehouses

### de

* Fügt den Im- und Export von Beständen, Lagerplätzen, Lieferanten und Lieferanten-Artikel-Zuordnungen hinzu (erfordert das "Shopware Import/Export" Plugin)
* Fügt ein konfigurierbares und erweiterbares Dokumententemplate für Lieferantenbestellungen hinzu
* Verbessert die Sortierreihenfolge in der Artikel-Bestandsliste
* Behebt einen Fehler beim Erstellen von Varianten, der dazu führte, dass die Varianten den gleichen Bestand hatten wie die Hauptvariante
* Behebt einen Fehler in der Aktualisierung des Verfügbarkeitszählers im Stapelverarbeitungsmodus
* Behebt einen Fehler bei der Stornierung von Versandkosten einer Netto-Bestellung
* Behebt einen Fehler, der das Löschen von Lagern verhinderte


## 3.2.7

### en

* Improves the stability of the plugin update

### de

* Verbessert die Stabilität des Plugin-Updates


## 3.2.6

### en

* Fixes a sporadically occurring error in the plugin update

### de

* Behebt einen sporadisch auftretenden Fehler im Plugin-Update


## 3.2.5

### en

* Fixes a potentially occurring inconsistency in the stock data

### de

* Behebt eine eventuell auftretende Inkonsistenz in den Bestandsdaten


## 3.2.4

### en

* Update of the "About Pickware" menu
* Fixes a bug in the automatic canceling of shipping costs, when the user changes the order status to "canceled / rejected".

### de

* Überarbeitung des "Über Pickware"-Menüs
* Behebt einen Fehler bei der automatischen Stornierung von Versandkosten, wenn der Bestellstatus auf "Storniert / Abgelehnt" geändert wird

## 3.2.3

### en

* Improves the usablity of the stock planning
* Fixes a bug in the stock initialization that caused the stocks to be greater than displayed
* Fixes a bug that caused duplicated articles to not show up in any of the Pickware apps
* Fixes the order cancellation to re-calculate the order amount correctly

### de

* Verbessert die Benutzbarbeit der Bestandsplanung
* Behebt einen Fehler in der Bestandsinitialisierung der dazu führte, dass die Bestände nach der Initialisierung größer waren als angezeigt
* Behebt einen Fehler der dazu führte, dass duplizierte Artikel nicht in den Pickware Apps angezeigt wurden
* Behebt einen Fehler in der Stornierung von Bestellung, sodass der Bestellwert nun wieder korrekt berechnet wird


## 3.2.2

### en

* Fixes some problems that may lead to situations where the number of default warehouses is not exactly 1.

### de

* Behebt einige Probleme, die dazu führen konnten dass nicht genau ein Standardlager existiert.


## 3.2.1

### en

* Adds an incompatibility warning for plugin "Lagerbestand Protokoll"
* Disable sorting in stock overview
* Assign new articles to the default storage location to make them available in the apps

### de

* Fügt einen Inkompatibilitätshinweis für das Plugin "Lagerbestand Protokoll" hinzu
* Verhindert Fehler beim Sortieren der Lagerbestandsübersicht
* Ordnet neue Artikel dem Standardlagerplatz zu, damit sie in den Apps angezeigt werden

## 3.2.0

### en

* Adds report "stock turnover rate".
* Fixes a view error with low resolution displays.
* Fixes a problem when editing multiple article variants.
* Fixes timeout issues faced when changing the bin location of articles.
* Fixes an issue when migrating from older versions.

### de

* Fügt die Auswertung "Lagerumschlagshäufigkeit" hinzu.
* Behebt einen Anzeigefehler bei niedrigauflösenden Displays.
* Behebt ein Problem beim Bearbeiten von mehreren Artikelvarianten nacheinander.
* Behebt ein Timeout-Problem bei der Änderung des Lagerplatzes von Artikeln.
* Behebt ein Problem bei der Migration von älteren Versionen.


## 3.1.4

### en

* Fixes a problem when stocking newly-created articles.

### de

* Behebt einen Fehler bei der Einlagerung neu erstellter Artikel.


## 3.1.3

### en

* Fixes a problem when stocking articles and assigning storage bins.
* Fixes a problem when exporting the rated stock.

### de

* Behebt einen Fehler bei der Einlagerung und Lagerplatzänderung von Artikeln.
* Behebt einen Fehler beim Export des bewerteten Warenbestands


## 3.1.2

### en

* Fixes a problem when saving new articles.

### de

* Behebt einen Fehler beim Speichern neu angelegter Artikel.


## 3.1.1

### en

* Fixes the upgrade error "Integrity constraint violation: 1022 Can't write; duplicate key in table [...]".

### de

* Behebt den Fehler bei Aktualisierung "Integrity constraint violation: 1022 Can't write; duplicate key in table [...]".


## 3.1.0

### en

* It is now possible to create additional warehouses using the warehouse management (Items > Warehouse > Warehouse management)
* Bin locations can now be generated in the warehouse management using a customizable schema
* When sending an order document by email the document titles are now translated and use the respective document identifier (e.g. invoice number) instead of the order number, if possible
* The email used for sending invoice documents to the archive now uses a customizable template

### de

* Ab sofort ist es möglich über die Lagerverwaltung (Artikel > Lager > Lagerverwaltung) zusätzliche Lager anzulegen
* Es ist nun möglich in der Lagerverwaltung Lagerplätze anhand eines anpassbaren Schemas zu generieren
* Beim Senden von Bestelldokumenten per E-Mail werden die Dateinamane ab sofort übersetzt und enthalten die entsprechende Dokumentennummer (z.B. Rechnungsnummer) anstelle der Bestellnummer, falls möglich
* E-Mails, die an das Rechnungsarchiv geschickt werden, verwenden nun ein anpassbares Template


## 3.0.29

### en

* Fixes the adjustment of the physical stock upon importing an article, in case the property "instock" is not set by the import

### de

* Behebt die fehlerhafte Aktualisierung des Lagerbestands beim Import eines Artikels, falls kein neuer Wert für das Feld "instock" gesetzt wird


## 3.0.28

### en

* Fixes a broken resource file
* Improves the compatibility with PHP 7

### de

* Repariert eine kaputte Ressource-Datei
* Verbessert die Kompatibilität mit PHP 7


## 3.0.27

### en

* Improves the compatibility with other Pickware plugins

### de

* Verbessert die Kompatibilität mit anderen Pickware plugins
