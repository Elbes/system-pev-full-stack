<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //INSERÇÃO DE DADOS TB_PERMISSÃO
         DB::table('Permissao')->insert([
            'nome_permissao'         => 'view_home',
            'dsc_permissao'          => 'Visualiza tela Dashboard',
            'dhs_cadastro'           => Carbon::now()
        ]);

        DB::table('Permissao')->insert([
            'nome_permissao'         => 'view_pg_entradas',
            'dsc_permissao'          => 'Visualiza tela de registros das entradas nos PEVs',
            'dhs_cadastro'           => Carbon::now()
        ]);

        DB::table('Permissao')->insert([
            'nome_permissao'         => 'view_pg_unidades',
            'dsc_permissao'          => 'Visualiza tela de controle das Unidades/PEVs',
            'dhs_cadastro'           => Carbon::now()
        ]);

        DB::table('Permissao')->insert([
            'nome_permissao'         => 'view_pg_usuarios',
            'dsc_permissao'          => 'Visualiza tela de controle de Usuários',
            'dhs_cadastro'           => Carbon::now()
        ]);

        DB::table('Permissao')->insert([
            'nome_permissao'         => 'view_pg_menu',
            'dsc_permissao'          => 'Visualiza tela de controle de Menus',
            'dhs_cadastro'           => Carbon::now()
        ]);

        DB::table('Permissao')->insert([
            'nome_permissao'         => 'view_pg_perfil',
            'dsc_permissao'          => 'Visualiza tela de controle de Perfis',
            'dhs_cadastro'           => Carbon::now()
        ]);

        DB::table('Permissao')->insert([
            'nome_permissao'         => 'view_pg_permissao',
            'dsc_permissao'          => 'Visualiza tela de controle de Perimissões',
            'dhs_cadastro'           => Carbon::now()
        ]);

        //INSERÇÃO DE DADOS TB_PERFIL
        DB::table('Perfil')->insert([
            'tipo_perfil'         => 'ADMG',
            'nome_perfil'         => 'Administrador Geral',
            'dsc_perfil'          => 'Possui acesso total ao sistema',
            'dhs_cadastro'        => Carbon::now()
        ]);
        

        DB::table('Perfil')->insert([
            'tipo_perfil'         => 'OPE',
            'nome_perfil'         => 'Operador',
            'dsc_perfil'          => 'Possui acesso ao registro de entradas',
            'dhs_cadastro'        => Carbon::now()
        ]);

        DB::table('Perfil')->insert([
            'tipo_perfil'         => 'ADM',
            'nome_perfil'         => 'Administrador',
            'dsc_perfil'          => 'Possui acesso de gestão de usuários e dashboards',
            'dhs_cadastro'        => Carbon::now()
        ]);

       /* DB::table('Perfil')->insert([
            'tipo_perfil'         => 'Sem Perfil',
            'nome_perfil'         => 'Aguardando Liberação',
            'dsc_perfil'          => 'Ainda não possui perfil definido no sistema',
            'dhs_cadastro'        => Carbon::now()
        ]); */

        //INSERÇÃO DE DADOS TB_PERMISSAO_PERFIL
        DB::table('PerfilPermissao')->insert([
            'id_perfil'         => 1,
            'id_permissao'      => 1,
            'dhs_cadastro'      => Carbon::now()
        ]);

        DB::table('PerfilPermissao')->insert([
            'id_perfil'         => 1,
            'id_permissao'      => 2,
            'dhs_cadastro'      => Carbon::now()
        ]);

        DB::table('PerfilPermissao')->insert([
            'id_perfil'         => 1,
            'id_permissao'      => 3,
            'dhs_cadastro'      => Carbon::now()
        ]);

        DB::table('PerfilPermissao')->insert([
            'id_perfil'         => 1,
            'id_permissao'      => 4,
            'dhs_cadastro'      => Carbon::now()
        ]);
        DB::table('PerfilPermissao')->insert([
            'id_perfil'         => 1,
            'id_permissao'      => 5,
            'dhs_cadastro'      => Carbon::now()
        ]);
        DB::table('PerfilPermissao')->insert([
            'id_perfil'         => 1,
            'id_permissao'      => 6,
            'dhs_cadastro'      => Carbon::now()
        ]);
        DB::table('PerfilPermissao')->insert([
            'id_perfil'         => 1,
            'id_permissao'      => 7,
            'dhs_cadastro'      => Carbon::now()
        ]);

        DB::table('PerfilPermissao')->insert([
            'id_perfil'         => 2,
            'id_permissao'      => 2,
            'dhs_cadastro'      => Carbon::now()
        ]);

        DB::table('PerfilPermissao')->insert([
            'id_perfil'         => 3,
            'id_permissao'      => 1,
            'dhs_cadastro'      => Carbon::now()
        ]);

        DB::table('PerfilPermissao')->insert([
            'id_perfil'         => 3,
            'id_permissao'      => 2,
            'dhs_cadastro'      => Carbon::now()
        ]);

        DB::table('PerfilPermissao')->insert([
            'id_perfil'         => 3,
            'id_permissao'      => 3,
            'dhs_cadastro'      => Carbon::now()
        ]);

        DB::table('PerfilPermissao')->insert([
            'id_perfil'         => 3,
            'id_permissao'      => 4,
            'dhs_cadastro'      => Carbon::now()
        ]);


         //INSERÇÃO DE DADOS MENU
         DB::table('Menu')->insert([
            'id_menu_referencia'  => null,
            'id_permissao'        => 1,
            'nome_menu'           => 'Dashboard',
            'url_menu'            => 'home',
            'icon_menu'           => 'fa fa-chart-simple',
            'num_ordem'           => 1,
            'dhs_cadastro'        => Carbon::now()
        ]);

        DB::table('Menu')->insert([
            'id_menu_referencia'  => null,
            'id_permissao'        => 2,
            'nome_menu'           => 'Entradas',
            'url_menu'            => 'form-entradas',
            'icon_menu'           => 'fa fa-person-walking-arrow-right',
            'num_ordem'           => 2,
            'dhs_cadastro'        => Carbon::now()
        ]);

        DB::table('Menu')->insert([
            'id_menu_referencia'  => null,
            'id_permissao'        => 3,
            'nome_menu'           => 'Unidades - PEVs',
            'url_menu'            => 'lista-unidade',
            'icon_menu'           => 'fa fa-home',
            'num_ordem'           => 3,
            'dhs_cadastro'        => Carbon::now()
        ]);

        DB::table('Menu')->insert([
            'id_menu_referencia'  => null,
            'id_permissao'        => 4,
            'nome_menu'           => 'Usuários',
            'url_menu'            => 'lista-usuarios',
            'icon_menu'           => 'fa fa-users-gear',
            'num_ordem'           => 4,
            'dhs_cadastro'        => Carbon::now()
        ]);

        DB::table('Menu')->insert([
            'id_menu_referencia'  => null,
            'id_permissao'        => 5,
            'nome_menu'           => 'Menu',
            'url_menu'            => 'lista-menu',
            'icon_menu'           => 'fa fa-solid fa-bars',
            'num_ordem'           => 5,
            'dhs_cadastro'        => Carbon::now()
        ]);

        DB::table('Menu')->insert([
            'id_menu_referencia'  => null,
            'id_permissao'        => 6,
            'nome_menu'           => 'Perfil',
            'url_menu'            => 'lista-perfil',
            'icon_menu'           => 'fa fa-solid fa-address-card',
            'num_ordem'           => 6,
            'dhs_cadastro'        => Carbon::now()
        ]);

        DB::table('Menu')->insert([
            'id_menu_referencia'  => null,
            'id_permissao'        => 7,
            'nome_menu'           => 'Permissão',
            'url_menu'            => 'lista-permissao',
            'icon_menu'           => 'fa fa-solid fa-arrow-up-right-from-square',
            'num_ordem'           => 7,
            'dhs_cadastro'        => Carbon::now()
        ]);

        

        //INSERÇÃO DE DADOS RA
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'I',
            'nome_ra'          => strtoupper('Plano Piloto'),
            'dhs_cadastro'     => Carbon::now()
        ]);

        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'II',
            'nome_ra'          => strtoupper('Gama'),
            'dhs_cadastro'     => Carbon::now()
        ]);

        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'III',
            'nome_ra'          => strtoupper('Taguatinga'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'IV',
            'nome_ra'          => strtoupper('Brazlândia'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'V',
            'nome_ra'          => strtoupper('Sobradinho'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        //6
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'VI',
            'nome_ra'          => strtoupper('Planaltina'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        //7
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'VII',
            'nome_ra'          => strtoupper('Paranoá'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        //8
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'VIII',
            'nome_ra'          => strtoupper('Núcleo Bandeirante'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'IX',
            'nome_ra'          => strtoupper('Ceilândia'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'X',
            'nome_ra'          => strtoupper('Guará'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XI',
            'nome_ra'          => strtoupper('Cruzeiro'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XII',
            'nome_ra'          => strtoupper('Samambaia'),
            'dhs_cadastro'     => Carbon::now()
        ]);

        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XIII',
            'nome_ra'          => strtoupper('Santa Maria'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XIV',
            'nome_ra'          => strtoupper('São Sebastião'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XV',
            'nome_ra'          => strtoupper('Recanto das Emas'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XVI',
            'nome_ra'          => strtoupper('Lago Sul'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XVII',
            'nome_ra'          => strtoupper('Riacho Fundo'),
            'dhs_cadastro'     => Carbon::now()
        ]);

        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XVIII',
            'nome_ra'          => strtoupper('Lago Norte'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XIX',
            'nome_ra'          => strtoupper('Candangolândia'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XX',
            'nome_ra'          => strtoupper('Águas Claras'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XXI',
            'nome_ra'          => strtoupper('Riacho Fundo II'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XXII',
            'nome_ra'          => strtoupper('Sudoeste/Octogonal'),
            'dhs_cadastro'     => Carbon::now()
        ]);

        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XXIII',
            'nome_ra'          => strtoupper('Varjão'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XXIV',
            'nome_ra'          => strtoupper('Park Way'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XXV',
            'nome_ra'          => strtoupper('SCIA'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XXVI',
            'nome_ra'          => strtoupper('Sobradinho II'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XXVII',
            'nome_ra'          => strtoupper('Jardim Botânico'),
            'dhs_cadastro'     => Carbon::now()
        ]);

        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XXVIII',
            'nome_ra'          => strtoupper('Itapoã'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XXIX',
            'nome_ra'          => strtoupper('SIA'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XXX',
            'nome_ra'          => strtoupper('Vicente Pires'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XXXI',
            'nome_ra'          => strtoupper('Fercal'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XXXII',
            'nome_ra'          => strtoupper('Sol Nascente/Pôr do Sol'),
            'dhs_cadastro'     => Carbon::now()
        ]);

        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XXXIII',
            'nome_ra'          => strtoupper('Arniqueira'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XXXIV',
            'nome_ra'          => strtoupper('Arapoanga'),
            'dhs_cadastro'     => Carbon::now()
        ]);
        
        DB::table('RegiaoAdministrativa')->insert([
            'numero_ra'        => 'XXXV',
            'nome_ra'          => strtoupper('Água Quente'),
            'dhs_cadastro'     => Carbon::now()
        ]);

        //INSERÇÃO DE DADOS TB_UNIDADE_SERVICO
        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Brazlândia 1'),
            'id_ra'        => 4,
            'endereco'     => strtoupper('Setor Norte AE 2N Lt M'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Brazlândia 2'),
            'id_ra'        => 4,
            'endereco'     => strtoupper('Quadra 33 Área Especial 3, Vila São José'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Planaltina'),
            'id_ra'        => 6,
            'endereco'     => strtoupper('Área Especial Norte 18'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Sobradinho I - 1'),
            'id_ra'        => 5,
            'endereco'     => strtoupper('Quadra 10, Área especial 01'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Sobradinho I - 2'),
            'id_ra'        => 5,
            'endereco'     => strtoupper('AE 3 para Industria Lt 7/10'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Sobradinho II'),
            'id_ra'        => 16,
            'endereco'     => strtoupper('Buritis'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Paranoá'),
            'id_ra'        => 7,
            'endereco'     => strtoupper('Quadra 5, Conjunto D, Lote 4'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho São Sebastião 1'),
            'id_ra'        => 14,
            'endereco'     => strtoupper('Q 305 Cj 14 AE 2 - Núcleo de Limpeza SLU'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho São Sebastião 2'),
            'id_ra'        => 14,
            'endereco'     => strtoupper('Bairro Crixás, Rua 33, Lote 10'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Santa Maria 1'),
            'id_ra'        => 13,
            'endereco'     => strtoupper('Quadra AC 219 Lote 1 Fazenda Saia Velha'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Santa Maria 2'),
            'id_ra'        => 13,
            'endereco'     => strtoupper('AC-105'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Gama'),
            'id_ra'        => 2,
            'endereco'     => strtoupper('Av Contorno Área Especial Lote 2 - Setor Norte'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Gama 2'),
            'id_ra'        => 2,
            'endereco'     => strtoupper('Entre a Q 6 e 12 - Setor Sul'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Asa Sul'),
            'id_ra'        => 1,
            'endereco'     => strtoupper('SCES Lt 5'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Guará 1'),
            'id_ra'        => 10,
            'endereco'     => strtoupper('SRIA II QE 25 AE 1 CAV'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Guará 2'),
            'id_ra'        => 10,
            'endereco'     => strtoupper('SRIA II AE 10 Lt A PM'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Recanto das Emas'),
            'id_ra'        => 15,
            'endereco'     => strtoupper('AE 2'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Águas Claras'),
            'id_ra'        => 20,
            'endereco'     => strtoupper('Av. Jacarandá, Lote 24'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Samambaia'),
            'id_ra'        => 12,
            'endereco'     => strtoupper('QR 608 atrás do Conjunto 7'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Ceilândia 1'),
            'id_ra'        => 9,
            'endereco'     => strtoupper('Setor N QNN 29 AE G/K'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Ceilândia 2'),
            'id_ra'        => 9,
            'endereco'     => strtoupper('Setor M QNM 27 Lt C'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Taguatinga'),
            'id_ra'        => 3,
            'endereco'     => strtoupper('QNG 9 Área Especial'),
            'dhs_cadastro' => Carbon::now()
        ]);

        DB::table('UnidadeServico')->insert([
            'nome'         => strtoupper('Papa-entulho Sol Nascente/Pôr do Sol'),
            'id_ra'        => 32,
            'endereco'     => strtoupper('QNP 28 Área Especial SH Sol Nascente Lt S/n'),
            'dhs_cadastro' => Carbon::now()
        ]);


        //INSERÇÃO DE DADOS TIPO_RESIDUO
        DB::table('TipoResiduo')->insert([
            'nome_residuo'        => 'RCC',
            'dhs_cadastro'     => Carbon::now()
        ]);

        DB::table('TipoResiduo')->insert([
            'nome_residuo'        => 'PODAS',
            'dhs_cadastro'     => Carbon::now()
        ]);

        DB::table('TipoResiduo')->insert([
            'nome_residuo'        => 'VOLUMOSOS',
            'dhs_cadastro'     => Carbon::now()
        ]);

        DB::table('TipoResiduo')->insert([
            'nome_residuo'        => 'RECICLÁVEIS',
            'dhs_cadastro'     => Carbon::now()
        ]);

        //INSERÇÃO NA TABELA USUARIOS
        DB::table('Usuarios')->insert([
            'nom_usuario'    => strtoupper('Administrador Geral'),
            'num_cpf'        => '15315236155',
            'dat_nascimento' => '1990-09-09',
            'id_unidade'      => 1,
            'id_perfil'      => 1,
            'dsc_email'      => 'admin@gmail.com',
            'pws_senha'      => Hash::make('1010'),
            'sit_usuario'    => 'A',
            'dhs_cadastro'   => Carbon::now()
        ]);

        DB::table('Usuarios')->insert([
            'nom_usuario'    => strtoupper('Administrador Teste'),
            'num_cpf'        => '15315236155',
            'dat_nascimento' => '1990-09-09',
            'id_unidade'      => 1,
            'id_perfil'      => 3,
            'dsc_email'      => 'administrador@gmail.com',
            'pws_senha'      => Hash::make('1010'),
            'sit_usuario'    => 'A',
            'dhs_cadastro'   => Carbon::now()
        ]);

        DB::table('Usuarios')->insert([
            'nom_usuario'    => strtoupper('Operador teste'),
            'num_cpf'        => '15315236155',
            'dat_nascimento' => '1985-09-09',
            'id_unidade'      => 1,
            'id_perfil'      => 2,
            'dsc_email'      => 'operador@gmail.com',
            'pws_senha'      => Hash::make('1010'),
            'sit_usuario'    => 'A',
            'dhs_cadastro'   => Carbon::now()
        ]);
    }
}
