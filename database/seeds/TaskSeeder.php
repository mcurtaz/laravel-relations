<?php

use Illuminate\Database\Seeder;
use App\Task;
use App\Employee;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // le tabelle locations e employees sono già state create quando viene lanciato il TaskSeeder. La tabella tasks ha una relazione molti a molti con employees. Ci sarà quindi una tabella ponte in cui ogni riga sarà un associazione task_id e employee_id. Ogni task_id potrà comparire in più righe e quindi essere associato a più employee e viceversa. In teoria la cosa che non può succedere è che ci sia ripetuta più di una volta la stessa relazione tra lo stesso task e lo stesso employee. singolarmente possono comparire più volte ma come coppia devono essere unique. Comunque per popolare la tabella dobbiamo fare use App\Task; ma anche use App\Employee;

        factory(Task::class, 100) -> create() //Cominciamo a creare la tabella task. Si può fare create e non make perchè la chiave esterna è nella tabella ponte non nella tabella tasks (in pratica se creo nella tabella ponte una riga con task_id 5 deve esistere nella tabella tasks un elemento con id 5)
                                  -> each(function($tas){ // dopo aver creato la tabella con tutti i suoi dati fake devo associare ogni task con un numero di employee. richiamo la funzione each che cicla su tutte le righe della tabella tasks appena creata

                                    $emp = Employee::inRandomOrder() -> take(rand(2, 5)) -> get(); // per ogni riga creo una variabile emp composta così: - inRandomOrder prende tutti gli elementi di Employee in ordine sparso. - take() serve a prendere gli elementi che ci servono. Come argomento gli passiamo quanti elementi deve prendere (in questo caso usiamo rand(2,5) per dirgli di prenderne un numero random tra 2 e 5.) Per decidere quanti deve prenderne bisognerebbe fare un ragionamento per esempio potrebbe un task avere 0 employee assegnati? quanti employee al massimo possiamo assegnare ad un task? comunque per questo caso scuola va bene così. - get() dopo take serve get() per prendere effettivamente quei n elementi random dalla tabella employees e metterni nella variabile $emp

                                    $tas -> employees() -> attach($emp); // $tas è la riga di tasks su cui di volta in volta stiamo ciclando con l'each. chiamiamo il metodo employees (che non è un metodo a caso ma è quello definito nel model Task quello con $this -> belongsToMany). da lì facciamo attach() e gli passiamo gli elementi random presi dalla tabella employees. Quindi lui assocerà nella tabella ponte di volta in volta quel task con delle righe random (da 2 a 5) prese da employees. 
                                    
                                    
                                    //-------------  ATTENZIONE: Come fa laravel a sapere in quale tabella, in quale colonna, cosa metterci ecc ecc ecc. Qualcosina abbiamo esplicitato noi per esempio creando le relazioni tra le tabelle nella migration add_foreign_keys o nei Model creando i metodi employees() e tasks() e così ma molto è dedotto/automatizzato da laravel grazie alla nomenclatura che abbiamo usato in linea con quella che laravel si aspetta. (per esempio è molto importante che la tabella ponte si chiami con create_nomi delle tabelle al singolare in ordine alfabetico_table). Si può non rispettare la nomenclatura di laravel ma bisogna esplicitare molte più cose e ci si complica un po' il lavoro. Il senso dei framework è quello che anche se da un lato ti limitano un po' le scelte dall'altro ti facilitano molto il lavoro.
                                  });
    }
}
