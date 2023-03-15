# README

## Einleitung:
Dies ist ein WordPress-Plugin, das es dem Administrator ermöglicht, Veranstaltungen zu erstellen und zu verwalten. Der Administrator kann Veranstaltungen mit Titel, Beschreibung, Datum und verfügbaren Plätzen hinzufügen. Das Plugin erstellt einen benutzerdefinierten Post-Typ namens `tk-events`, eine Datenbanktabelle namens `t-events-manager` und eine Seite mit dem Slug `tk-events`, auf der Benutzer Veranstaltungen anzeigen und sich dafür anmelden können.

## Installation:
1. Laden Sie die Plugin-Zip-Datei herunter.
2. Laden Sie die Zip-Datei in das WordPress-Plugin-Verzeichnis hoch.
3. Aktivieren Sie das Plugin.

## Verwendung:
1. Melden Sie sich als Administrator auf Ihrer WordPress-Website an.
2. Klicken Sie im WordPress-Dashboard auf das Menü `tk-events`.
3. Klicken Sie auf die Schaltfläche "Neu hinzufügen", um eine neue Veranstaltung zu erstellen.
4. Geben Sie den Veranstaltungstitel, die Beschreibung, das Datum und die verfügbaren Plätze als Post-Metas ein.
5. Veröffentlichen Sie die Veranstaltung.
6. Benutzer können jetzt Veranstaltungen auf der Seite `tk-events` anzeigen und sich dafür anmelden.

## Datenbank:
Das Plugin erstellt eine Datenbanktabelle namens `t-events-manager`, um die E-Mail-Adresse des Benutzers und die Veranstaltungs-ID zu speichern. Diese Tabelle hat zwei Spalten: E-Mail und `event_id`.

## Benutzerdefinierter Post-Typ:
Das Plugin erstellt einen benutzerdefinierten Post-Typ namens `tk-events` zur Verwaltung von Veranstaltungen. Der benutzerdefinierte Post-Typ verfügt über folgende Standardfunktionen: Titel, Editor, Autor, Thumbnail, Ausschnitt, Rückverweise, benutzerdefinierte Felder, Kommentare, Überarbeitungen und Seiteneigenschaften.

## Seite:
Das Plugin erstellt eine Seite mit dem Slug `tk-events`, um Veranstaltungen anzuzeigen. Diese Seite verwendet die WordPress-Schleife, um Veranstaltungen anzuzeigen, und ein benutzerdefiniertes Anmeldeformular, damit Benutzer sich für Veranstaltungen anmelden können.

## Sicherheit:
Das Plugin verwendet WordPress-Nonces, um Cross-Site-Request-Forgery-Angriffe zu verhindern. Es bereinigt und validiert auch die Benutzereingabe, um SQL-Injektionen und XSS-Angriffe zu verhindern.

## Kompatibilität:
Dieses Plugin wurde mit WordPress-Version 6.1 und höher getestet. Es kann mit früheren Versionen funktionieren, ist jedoch nicht garantiert.
