<?php
include_once 'basic_doc.php';

    class HomeDoc extends BasicDoc {
        protected function showHeader()
        {
            echo "Home";
        }
        protected function showContent() {		
            echo '
                <h1>Welkom</h1>
                   <p>
                    Welkom op de eerste website gemaakt door Ruben van der Zouw.
                   </p>';
        }
    }