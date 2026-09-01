<?php
// wp-content/themes/las-wp/inc/fields-eventos.php

if (function_exists('acf_add_local_field_group')):

    acf_add_local_field_group(array(
        'key' => 'group_eventos',
        'title' => 'Detalhes do Evento',
        'fields' => array(

            // ─── Imagem & Tipo ─────────────────────────────────────────────
            array(
                'key' => 'field_evento_is_featured',
                'label' => 'Evento em Destaque',
                'name' => 'is_featured',
                'type' => 'true_false',
                'instructions' => 'Marque para colocar este evento em destaque principal no topo (Hero) da página de eventos.',
                'default_value' => 0,
                'ui' => 1,
            ),
            array(
                'key' => 'field_evento_img',
                'label' => 'Imagem do Evento',
                'name' => 'img',
                'type' => 'image',
                'instructions' => 'Selecione a imagem de destaque do evento. (A prioridade pode ser desta imagem antes do Thumbnail do post)',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
            array(
                'key' => 'field_evento_image_type',
                'label' => 'Tipo de Imagem',
                'name' => 'image_type',
                'type' => 'select',
                'instructions' => 'Selecione o formato da imagem para adaptação no layout',
                'choices' => array(
                    'quadrada' => 'Quadrada',
                    'banner' => 'Banner (Retangular)',
                    'icon' => 'Ícone (Redondo)',
                ),
                'default_value' => 'quadrada',
                'return_format' => 'value',
            ),

            array(
                'key' => 'field_evento_format',
                'label' => 'Formato do Evento',
                'name' => 'event_format',
                'type' => 'select',
                'instructions' => 'Formato específico exibido na tag do card',
                'choices' => array(
                    'jantar_cientifico' => 'Jantar Científico',
                    'curso' => 'Curso',
                    'congresso' => 'Congresso',
                    'feira' => 'Feira',
                    'simposio' => 'Simpósio',
                    'workshop' => 'Workshop',
                    'outro' => 'Outro',
                ),
                'default_value' => 'jantar_cientifico',
                'return_format' => 'value',
            ),

            // ─── Data & Hora ────────────────────────────────────────────────
            array(
                'key' => 'field_evento_full_date',
                'label' => 'Data Completa do Evento (para contagem regressiva)',
                'name' => 'full_date',
                'type' => 'date_time_picker',
                'instructions' => 'Selecione a data e hora exatas do início do evento. Necessário para exibir a contagem regressiva.',
                'display_format' => 'd/m/Y H:i',
                'return_format' => 'Y-m-d H:i:s',
                'first_day' => 0,
                'required' => 0,
            ),
            array(
                'key' => 'field_evento_date_number',
                'label' => 'Dia (exibição)',
                'name' => 'date_number',
                'type' => 'text',
                'instructions' => 'Ex: 09 ou 29-31',
                'required' => 1,
            ),
            array(
                'key' => 'field_evento_month',
                'label' => 'Mês (exibição)',
                'name' => 'month',
                'type' => 'text',
                'instructions' => 'Ex: OUTUBRO',
                'required' => 1,
            ),
            array(
                'key' => 'field_evento_year',
                'label' => 'Ano',
                'name' => 'year',
                'type' => 'text',
                'instructions' => 'Ex: 2025',
                'required' => 1,
            ),
            array(
                'key' => 'field_evento_hours',
                'label' => 'Horário',
                'name' => 'hours',
                'type' => 'text',
                'instructions' => 'Ex: 14h às 18h (Pode deixar em branco)',
                'required' => 0,
            ),

            // ─── Palestrantes ───────────────────────────────────────────────
            array(
                'key' => 'field_evento_speaker',
                'label' => 'Palestrante',
                'name' => 'speaker',
                'type' => 'text',
                'required' => 0,
            ),
            array(
                'key' => 'field_evento_moderator',
                'label' => 'Moderador',
                'name' => 'moderator',
                'type' => 'text',
                'required' => 0,
            ),

            // ─── Localização ────────────────────────────────────────────────
            array(
                'key' => 'field_evento_local',
                'label' => 'Localização (exibição)',
                'name' => 'local',
                'type' => 'text',
                'instructions' => 'Ex: São Paulo/SP',
                'required' => 0,
            ),
            array(
                'key' => 'field_evento_address_street',
                'label' => 'Rua',
                'name' => 'address_street',
                'type' => 'text',
                'required' => 0,
            ),
            array(
                'key' => 'field_evento_address_number',
                'label' => 'Número',
                'name' => 'address_number',
                'type' => 'text',
                'required' => 0,
            ),
            array(
                'key' => 'field_evento_address_city',
                'label' => 'Cidade',
                'name' => 'address_city',
                'type' => 'text',
                'required' => 0,
            ),
            array(
                'key' => 'field_evento_address_state',
                'label' => 'Estado',
                'name' => 'address_state',
                'type' => 'text',
                'required' => 0,
            ),
            array(
                'key' => 'field_evento_map_embed_url',
                'label' => 'URL do Google Maps Embed',
                'name' => 'map_embed_url',
                'type' => 'url',
                'instructions' => 'Cole aqui a URL de incorporação do Google Maps (Maps > Compartilhar > Incorporar mapa > copiar apenas o src do iframe)',
                'required' => 0,
            ),
            array(
                'key' => 'field_evento_how_to_get',
                'label' => 'Como Chegar',
                'name' => 'how_to_get',
                'type' => 'textarea',
                'instructions' => 'Instruções de como chegar: estacionamento, aeroporto mais próximo, transporte público, etc.',
                'rows' => 4,
                'required' => 0,
            ),
            array(
                'key' => 'field_evento_partner_hotels',
                'label' => 'Hotéis Parceiros',
                'name' => 'partner_hotels',
                'type' => 'textarea',
                'instructions' => 'Liste hotéis parceiros próximos ao evento (útil para eventos fora de SP)',
                'rows' => 4,
                'required' => 0,
            ),

            // ─── Inscrição ──────────────────────────────────────────────────
            array(
                'key' => 'field_evento_subscribe',
                'label' => 'Link de Inscrição',
                'name' => 'subscribe',
                'type' => 'url',
                'instructions' => 'Link externo para comprar ingressos ou inscrever-se.',
                'required' => 0,
            ),
            array(
                'key' => 'field_evento_subscribe_type',
                'label' => 'Tipo de Inscrição',
                'name' => 'subscribe_type',
                'type' => 'select',
                'instructions' => 'Define o CTA principal do evento',
                'choices' => array(
                    'participar' => 'Quero Participar',
                    'visitar_estande' => 'Agende Visita ao Estande',
                    'saber_mais' => 'Saiba Mais',
                    'gratuito' => 'Participação Gratuita',
                    'convite' => 'Por Convite',
                    'vagas_limitadas' => 'Vagas Limitadas',
                ),
                'default_value' => 'participar',
                'return_format' => 'value',
            ),

            // ─── Informações de Feira ───────────────────────────────────────
            array(
                'key' => 'field_evento_booth_pavilion',
                'label' => 'Pavilhão',
                'name' => 'booth_pavilion',
                'type' => 'text',
                'instructions' => 'Ex: Pavilhão Azul',
                'required' => 0,
            ),
            array(
                'key' => 'field_evento_booth_number',
                'label' => 'Número do Estande',
                'name' => 'booth_number',
                'type' => 'text',
                'instructions' => 'Ex: Estande B-42 (apenas para feiras)',
                'required' => 0,
            ),
            array(
                'key' => 'field_evento_booth_map_url',
                'label' => 'Mapa do Pavilhão',
                'name' => 'booth_map_url',
                'type' => 'url',
                'instructions' => 'URL ou imagem do mapa do pavilhão da feira',
                'required' => 0,
            ),
            array(
                'key' => 'field_evento_booth_hours',
                'label' => 'Horário de Funcionamento do Estande',
                'name' => 'booth_hours',
                'type' => 'text',
                'instructions' => 'Ex: Seg a Sex: 9h às 18h | Sáb: 9h às 13h',
                'required' => 0,
            ),
            array(
                'key' => 'field_evento_booth_highlights',
                'label' => 'O que terá no Estande',
                'name' => 'booth_highlights',
                'type' => 'textarea',
                'instructions' => 'Descreva o que acontecerá no estande: lançamentos, demos de produto, etc.',
                'rows' => 3,
                'required' => 0,
            ),

            // ─── Prova Social (Eventos Passados) ────────────────────────────
            array(
                'key' => 'field_evento_gallery',
                'label' => 'Galeria do Evento (bastidores, plateia, jantar)',
                'name' => 'gallery',
                'type' => 'gallery',
                'instructions' => 'Adicione 3 a 5 fotos do evento realizado para exibir na seção de prova social.',
                'min' => 0,
                'max' => 10,
                'return_format' => 'array',
                'library' => 'all',
            ),
            array(
                'key' => 'field_evento_impact_number',
                'label' => 'Número de Impacto',
                'name' => 'impact_number',
                'type' => 'text',
                'instructions' => 'Ex: "40 médicos presentes", "3 estudos de caso apresentados". Exibido em destaque na seção de eventos passados.',
                'required' => 0,
            ),
            array(
                'key' => 'field_evento_recap_link',
                'label' => 'Link do Recap (Instagram/LinkedIn)',
                'name' => 'recap_link',
                'type' => 'url',
                'instructions' => 'Link para o post de recap do evento no Instagram ou LinkedIn.',
                'required' => 0,
            ),

            // ─── Patrocinadores ─────────────────────────────────────────────
            array(
                'key' => 'field_evento_sponsors',
                'label' => 'Patrocinadores / Marcas Parceiras',
                'name' => 'sponsors',
                'type' => 'repeater',
                'instructions' => 'Adicione os logos e nomes das marcas parceiras do evento.',
                'min' => 0,
                'max' => 20,
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key' => 'field_evento_sponsor_name',
                        'label' => 'Nome',
                        'name' => 'name',
                        'type' => 'text',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_evento_sponsor_logo',
                        'label' => 'Logo',
                        'name' => 'logo',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'required' => 0,
                    ),
                ),
            ),

            // ─── Compartilhamento & Calendário ──────────────────────────────
            array(
                'key' => 'field_evento_calendar_title',
                'label' => 'Título para Calendário',
                'name' => 'calendar_title',
                'type' => 'text',
                'instructions' => 'Título que aparecerá no Google Calendar/Outlook ao adicionar o evento. Se vazio, usa o título do post.',
                'required' => 0,
            ),
            array(
                'key' => 'field_evento_whatsapp_share_text',
                'label' => 'Texto para Compartilhar no WhatsApp',
                'name' => 'whatsapp_share_text',
                'type' => 'textarea',
                'instructions' => 'Texto pré-preenchido para compartilhamento via WhatsApp. Se vazio, gera automaticamente.',
                'rows' => 2,
                'required' => 0,
            ),

        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'evento',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_graphql' => 1,
        'graphql_field_name' => 'eventoacf',
        'map_graphql_types_from_location_rules' => 0,
        'graphql_types' => array(
            0 => 'Evento',
        ),
    ));

endif;
