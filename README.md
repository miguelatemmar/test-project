<small>
<b>Een beargumenteerde keuze in de wijze van authenthicatie</b> <br>
Voor authenticatie heb ik de authenticatie van Laravel gebruikt. <br>
Waarom heb ik dit gekozen? Ik heb gekozen voor Laravel
omdat Laravel een bekende Framework is. Laravel heeft ook 
een duidelijk documentatie, verder kan je ook veel Laravel instructies/tutorials 
vinden op het internet (laracast en youtube).  Ik heb nog nooit een login en 
register gerealiseerd, helemaal niet in Laravel.  <br>
Afgelopen weken werken we veel met Laraval, een login en registreer systeem bouwen  met Laravel zou 
het met meest voor de hand liggend zijn.
<br>
Voor het filteren van HTTP-verzoek heb ik Middleware gekozen. Dit heb ik
gekozen omdat dit werd uitgelegd in de Laracast video's en er staat een 
duidelijke beschrijving in de documentatie van Laravel. Middleware hebben we 
ook behandeld in de lessen.
</small><br><br>
                 
<small>
<b>Een beargumenteerde keuze in de wijze van authorisatie</b> <br>
Ik wil authorisatie op mijn crud, dus op een meerdere resources. Ik heb onderzoek 
gedaan welke authorisatie het beste voor mijn applicatie werkt.<br>
Voor authorisatie heb ik Policies gekozen. Ik heb niet gekozen voor Gates omdat
toepassing op acties niet gerelateerd zijn op een resource en dat wil juist wel hebben.
Gates is eigenlijk heel simple, je bent toegestaan of niet. Terwijl Policies instructies geeft
wie wel is toegestaan en wie niet.


</small>

<h2>Handleiding:</h2>

<small>Tips: 
<ul>
    <li>Volg deze tutorials: <b>https://laracasts.com/series/laravel-from-scratch-2018/episodes/24</b></li>
    en <b>https://laracasts.com/series/laravel-from-scratch-2018/episodes/26</b>
</ul>
</small>

<h4>Authenticatie</h4>
<b>Login en registreer systeem opzetten</b>

    1. Voer de volgende commando uit 'php artisan make:auth'
    2. Rechts boven verschijnt 'Login' en 'Register', klik op 'Register'
    3. Registreren werkt niet omdat er geen database is aangemaakt
    4. Maak een database aan en vul de juiste gegevens in het .ENV bestand
    5. Voer de migraties uit
    6. Je kan je nu registreren, inloggen en uitloggen
    
<b>Authenticatie op route</b> 

    1. Ga naar web.php
    2. Zet achter een route '->middleware('auth');' 
        [bijv. Route::get('/assignments/create', 'AssignmentsController@create')->middleware('auth');]
    3. De geselecteerde route is nu alleen te zien voor geauthenticeerde

<b>Authenticatie op items van gebruiker(s)</b>

    1. Voeg owner_id toe aan de gekozen migratie:
    
        $table->unsignedInteger('owner_id');
        
        $table->foreign('owner_id')->reference('id')->on('user')->onDelete('cascade');
        [onDelete('cascade') is optioneel]
                [als je de user verwijderd, worden de records van de user ook verwijderd]
        
    2. En voer deze migratie uit.
    
    3. Verander in de AssignmentsController de index function:
    
        $assignments = \App\Assignment::all();
        
        naar
        
        $assignments = \App\Assignment::where('owner_id', auth()->id())->get();
        
    4. Je kan een middleware in de routes toevoegen:
    
        Route::get('assignments/create', 'AssignmentsController@create')->middleware('auth');
        
        of in de controller
        
        public function __construct(){
            $this->middleware('auth')->exept(['index']);
                                     ->only('create, delete');
        }
        
    5. Nu wil je dat een gebruiker alleen zijn eigen opdrachten ziet, voer het volgende in de store functie uit:
    
        $assignment->owner_id = Auth::id();
        
        of
        
        $attributes['owner_id'] = auth()->id;
        Assignment::create($attributes + ['owner_id' => auth()->id()]);
        
    6. Nu worden de opdrachten per gebruiker getoond.
    
<hr>
<h4>Authorisatie</h4>

<b>Policy (rechten) op items van gebruiker(s)</b>

    1. Maak een Policy voor Assignments:
    
        php artisan make:policy AssignmentPolicy --model=Assignment
        
        [app > Policies > AssignmentPolicy]
    
    2. Voeg in de AssignmentPolicy onder public function view()  het volgende toe:
    
        return $assignment->owner_id == $user->id;
        
        Nu is er een policy gemaakt voor het bekijken van een assignment. 
        Dit is niet genoeg, hoe moet ook worden geregistreerd.
    
    3. Ga naar Providers > AuthServiceProvider, neem de onderstaande regel over:
    
        protected $policies = [
            'App\Assignment' => 'App\Policies\AssignmentPolicy'
        ]
    
    4. Verander de public function show() naar:
    
        $this->authorize('view', $assignment);
        return view('assignments.show', compact('assignment'));
    
    5. Nu kan een gebruiker alleen zijn assignments bekijken. Als gebruiker dat 
    toch probeert, verschijnt er een 403-error (This action is unauthorized).
    
    6. assignment bewerken