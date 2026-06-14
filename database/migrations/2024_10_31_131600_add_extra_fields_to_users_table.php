<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('raison_social')->nullable();
            $table->string('forme_juridique')->nullable();
            $table->text('activites_principales')->nullable();
            $table->string('adresse')->nullable();
            $table->string('fax')->nullable();
            $table->string('site_web')->nullable();
            $table->string('nom_responsable')->nullable();
            $table->string('titre_responsable')->nullable();
            $table->date('date_creation')->nullable();
            $table->string('chiffre_affaire')->nullable();
           
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'raison_social',
                'forme_juridique',
                'activites_principales',
                'adresse',
                'fax',
                'site_web',
                'nom_responsable',
                'titre_responsable',
                'date_creation',
                'chiffre_affaire',
            
            ]);
        });
    }
}
