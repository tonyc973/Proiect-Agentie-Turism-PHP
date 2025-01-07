# Descrierea proiectului MVC pentru agenția de turism

Acest proiect reprezintă o aplicație web dezvoltată pe baza arhitecturii MVC (Model-View-Controller) în PHP, destinată unei agenții de turism. Aplicația include funcționalități esențiale pentru gestionarea rezervărilor, tururilor și a utilizatorilor, fiind ușor de administrat și utilizat atât de către administratorii cât și utilizatorii platformei. Funcționalitățile sunt împărțite pe mai multe module, fiecare având un rol bine definit.

## Funcționalități principale:

### 1. Operații CRUD pentru rezervări și tururi
- **Adăugarea rezervărilor**: Utilizatorii pot rezerva un tur disponibil pe platformă. Aceste rezervări sunt stocate în baza de date, iar agenția poate vizualiza detalii despre fiecare rezervare.
- **Editarea rezervărilor**: Utilizatorii pot edita detalii ale tururilor pe care le-au rezervat.
- **Ștergerea rezervărilor**: Utilizatorii pot anula și apoi șterge o rezervare existentă.
- **Adăugarea tururilor**: Administratorii pot adăuga noi tururi, cu detalii precum destinație, descriere, preț.

### 2. Autentificare și înregistrare utilizatori
- **Pagina de logare**: Utilizatorii se pot autentifica în aplicație folosind email și o parolă.
- **Pagina de înregistrare**: Utilizatorii pot crea un cont pe platformă, completând un formular  detalii de contact.

### 3. Resetarea parolei (Forgot Password)
- Utilizatorii care au uitat parola pot solicita un e-mail de resetare a parolei. Acesta va conține un cod de resetare, pe care utilizatorul îl va introduce pentru a-și seta o parolă nouă.

### 4. Web Analytics pentru administratori
- **Statistici avansate**: Administrația platformei poate vizualiza statistici detaliate despre sesiune. Aceste informații sunt generate din datele colectate de la utilizatori și vizitatori.
- **Export date**: Adminul poate exporta datele statistice în formate CSV sau JSON.
- **Grafice interactive**: Datele sunt prezentate sub formă de grafice interactive.

### 5. Formular de contact
- Utilizatorii pot contacta agenția completând un formular online. Formularul include câmpuri pentru nume, email, subiect și mesaj.
- **ReCaptcha**: Pentru a preveni abuzurile, formularul de contact include un sistem ReCaptcha, asigurându-se că mesajele sunt trimise doar de către utilizatori reali.
- **Trimiterea mesajelor pe email**: Mesajele trimise prin formularul de contact sunt redirecționate automat către adresa de email a agenției pentru a fi gestionate.

### 6. **Securizarea Sesiunii Utilizatorului**

Aplicația utilizează sesiuni securizate pentru a asigura confidențialitatea utilizatorilor:

- **Cookie-uri Securizate**: Sesiunile sunt protejate prin cookie-uri care sunt configurate să funcționeze doar pe conexiuni HTTPS, să nu poată fi accesate din JavaScript și să nu fie trimise în cereri intersite, prevenind atacuri de tip XSS și CSRF.
  
- **Regenerarea ID-ului de Sesiune**: ID-ul sesiunii este regenerat la fiecare acces al utilizatorului, ceea ce previne atacurile de tip session fixation, asigurând că fiecare sesiune este unică și securizată.

- **Timeout pentru Sesiune**: Dacă un utilizator rămâne inactiv pentru mai mult de 15 minute, sesiunea sa este închisă automat pentru a preveni accesul neautorizat în caz de uitare a sesiunii.
