# Descrierea proiectului MVC PHP pentru agenție de turism

Acest proiect reprezintă o aplicație web dezvoltată pe baza arhitecturii MVC (Model-View-Controller) în PHP, destinată unei agenții de turism. Aplicația include funcționalități esențiale pentru gestionarea rezervărilor, tururilor și a utilizatorilor, fiind ușor de administrat atât de către angajații agenției, cât și de către administratorii platformei. Funcționalitățile sunt împărțite pe mai multe module, fiecare având un rol bine definit.

## Funcționalități principale:

### 1. Operațiuni CRUD pentru rezervări și tururi
- **Adăugarea rezervărilor**: Utilizatorii pot rezerva un tur disponibil pe platformă. Aceste rezervări sunt stocate în baza de date, iar agenția poate vizualiza detalii despre fiecare rezervare.
- **Ștergerea rezervărilor**: Administratorii pot șterge o rezervare existentă, în cazul în care aceasta nu mai este valabilă sau clientul solicită anularea.
- **Adăugarea tururilor**: Administratorii pot adăuga noi tururi, cu detalii precum destinație, descriere, preț și disponibilitate.
- **Modificarea tururilor**: Administratorii pot edita informațiile despre tururi, inclusiv prețuri, date de disponibilitate sau descriere.
- **Ștergerea tururilor**: Administratorii pot șterge tururi care nu mai sunt disponibile sau care nu mai sunt de interes.

### 2. Autentificare și înregistrare utilizatori
- **Pagina de logare**: Utilizatorii se pot autentifica în aplicație folosind un nume de utilizator și o parolă. Datele de autentificare sunt validate și securizate.
- **Pagina de înregistrare**: Utilizatorii pot crea un cont pe platformă, completând un formular cu informații personale și detalii de contact.
- **Verificare prin e-mail**: După înregistrare, utilizatorii primesc un e-mail de confirmare a contului.

### 3. Resetarea parolei (Forgot Password)
- Utilizatorii care au uitat parola pot solicita un e-mail de resetare a parolei. Acesta va conține un cod de resetare, pe care utilizatorul îl va introduce pentru a-și seta o parolă nouă.

### 4. Web Analytics pentru administratori
- **Statistici avansate**: Administrația platformei poate vizualiza statistici detaliate despre numărul de vizite, rezervări și tururi populare. Aceste informații sunt generate din datele colectate de la utilizatori și vizitatori.
- **Export date**: Administrația poate exporta datele statistice în formate CSV sau JSON pentru a le analiza ulterior sau a le partaja cu alți membri ai echipei.
- **Grafice interactive**: Datele sunt prezentate sub formă de grafice interactive pentru a oferi o imagine clară asupra performanței agenției.

### 5. Formular de contact
- Utilizatorii pot contacta agenția completând un formular online. Formularul include câmpuri pentru nume, email, subiect și mesaj.
- **ReCaptcha**: Pentru a preveni abuzurile, formularul de contact include un sistem ReCaptcha, asigurându-se că mesajele sunt trimise doar de către utilizatori reali.
- **Trimiterea mesajelor pe email**: Mesajele trimise prin formularul de contact sunt redirecționate automat către adresa de email a agenției pentru a fi gestionate.
