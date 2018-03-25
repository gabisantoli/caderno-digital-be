<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->truncate();

        DB::table('posts')->insert(
            [
                'title' => 'Entenda o por que do CodeIgniter ser melhor que o SpringBoot',
                'body' => '<p>Porque sim.</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => 6,
                'cover_image' => 'codeigniter_1522008602.jpg',
            ]
        );

        DB::table('posts')->insert(
            [
                'title' => 'Conteudo da aula de JavaWeb/Spring MVC',
                'body' => '<p>Link do conteúdo para quem faltou na aula: https://www.caelum.com.br/apostila-java-web/spring-mvc-autenticacao-e-autorizacao/</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => 3,
                'cover_image' => 'Spring-Logo_1522008682.png',
            ]
        );

        DB::table('posts')->insert(
            [
                'title' => 'Dúvida sobre o Sprint 1 da aula de LDS',
                'body' => '<p>A gente vai conseguir 10 no primeiro sprint?</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => 1,
                'cover_image' => 'pavalo_1522008656.jpg',
            ]
        );

        DB::table('posts')->insert(
            [
                'title' => 'Alguém tem o conteúdo da aula do Thiago do dia 13/03',
                'body' => '<p>A gente vai conseguir 10 no primeiro sprint?</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => 2,
                'cover_image' => 'jogo-pega-varetas-no-tubo-atacado_1522008643.jpg',
            ]
        );

        DB::table('posts')->insert(
            [
                'title' => 'Conteúdo de todo o semestre',
                'body' => '<p>O que teve enquanto eu estava de licença da maternidade?</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => 4,
                'cover_image' => 'conteudo_1522008614.png',
            ]
        );

        DB::table('posts')->insert(
            [
                'title' => 'Como apagar uma postagem do isfp?',
                'body' => '<p>Alguém tem IDEIA de como apagar essa postagem? Já tentei 00101 vezes</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => 8,
                'cover_image' => 'ISFP_1522008629.png',
            ]
        );

        DB::table('posts')->insert(
            [
                'title' => 'Duvida sobre funcionalidade do suap',
                'body' => '<p>Como eu faço para dar nota 10 para esse grupo?</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => 7,
                'cover_image' => 'suap_1522008696.jpg',
            ]
        );

        DB::table('posts')->insert(
            [
                'title' => 'Conteudo da aula do Rogério',
                'body' => '<p>Link do conteúdo para quem faltou na aula: https://www.normaseregras.com/normas-abnt/</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => 5,
                'cover_image' => 'Regras-da-ABNT-para-TCC_1522008668.png',
            ]
        );
    }
}
