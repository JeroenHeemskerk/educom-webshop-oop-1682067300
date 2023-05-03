<?php
require_once 'views/basic_doc.php';

class AboutDoc extends BasicDoc {
    protected function showHeader() {
        echo '<h1>Over mij</h1>';
    }
    protected function showContent() {
        echo '<p> 
                Hallo, mijn naam is Ruben van der Zouw.<br>
                Ik ben geboren op 13 maart 1995 in De Meern op de locatie waar op de dag van vandaag nog steeds mijn vaders bedrijfje staat.<br>
                Vanaf jongs af aan werd ik al een beetje gezien als de &rdquo;IT expert&rdquo; in onze familie omdat ik kleine probleempjes makkelijk en snel kon oplossen.<br>
                Verder heb ik altijd veel affiniteit met Techniek gehad, dit is eigenlijk niet zo heel raar omdat ik uit een bijna volledige technische familie kom.<br>
              </p>';
    }
}
?>