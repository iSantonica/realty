<?php

show_admin_bar(false);

function add_head_meta_tags()
{
    ?>
    <meta charset=<?php bloginfo('charset'); ?>>
    <meta name="HandheldFriendly" content="True" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="format-detection" content="address=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, shrink-to-fit=no">

    <link rel="shortcut icon" href="<?php bloginfo("template_url");?>/favico.png" type="image/x-icon">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php
}
add_action('wp_head', 'add_head_meta_tags');

if ( ! function_exists( 'realty_setup' ) ) :

	function realty_setup() {
	
		load_theme_textdomain( 'realty', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );


		add_theme_support( 'title-tag' );

	
		add_theme_support( 'post-thumbnails' );

	
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'realty' ),
		) );


		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );


		add_theme_support( 'custom-background', apply_filters( 'realty_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

	
		add_theme_support( 'customize-selective-refresh-widgets' );

	
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'realty_setup' );

add_image_size( 'my-tumb', 430, 300, true );
add_image_size( 'house', 400, 400, true );


function realty_content_width() {

	$GLOBALS['content_width'] = apply_filters( 'realty_content_width', 640 );
}
add_action( 'after_setup_theme', 'realty_content_width', 0 );

	add_filter('excerpt_more', function($more) {
		return '...';
	});

	add_filter( 'excerpt_length', function(){
		return 60;
	} );


function realty_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'realty' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'realty' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'realty_widgets_init' );


function realty_scripts() {
	wp_enqueue_style( 'realty-style', get_stylesheet_uri() );

	wp_enqueue_script( 'my_libs', get_template_directory_uri() . '/js/libs.js' );

   wp_enqueue_script( 'my_common', get_template_directory_uri() . '/js/common.js' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'realty_scripts' );

function add_theme_style(){
    wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css');
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick.css');
    wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/css/slick-theme.css');
    wp_enqueue_style( 'font-my', get_template_directory_uri() . '/css/fonts.css');
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css');
    wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.css');
    wp_enqueue_style( 'my_media', get_template_directory_uri() . '/css/media.css');
    
}
add_action( 'wp_enqueue_scripts', 'add_theme_style' );


require get_template_directory() . '/inc/custom-header.php';


require get_template_directory() . '/inc/template-tags.php';


require get_template_directory() . '/inc/template-functions.php';

require get_template_directory() . '/inc/customizer.php';


if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



		/*
	========================================================
		Register post type and tax
	========================================================
	*/

	add_action( 'init', 'register_post_types' );
function register_post_types(){
	register_post_type('house', array(
		'label'  => null,
		'labels' => array(
			'name'               => 'house', // основное название для типа записи
			'singular_name'      => 'house', // название для одной записи этого типа
			'add_new'            => 'Add new house', // для добавления новой записи
			'add_new_item'       => 'Add new house', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Edit house', // для редактирования типа записи
			'new_item'           => 'New house', // текст новой записи
			'view_item'          => 'View house', // для просмотра записи этого типа.
			'search_items'       => 'Search houses', // для поиска по этим типам записи
			'not_found'          => 'Not found', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Not found in trash', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'houses', // название меню
		),
		'description'         => '',
		'public'              => true,
		'menu_position'       => null,
		'menu_icon'           => null, 
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => array('title','editor', 'thumbnail'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => array('company', 'buildings'),
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	) );

	register_post_type('flat', array(
		'label'  => null,
		'labels' => array(
			'name'               => 'flats', // основное название для типа записи
			'singular_name'      => 'flat', // название для одной записи этого типа
			'add_new'            => 'Add new flat', // для добавления новой записи
			'add_new_item'       => 'Add new flat', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Edit flat', // для редактирования типа записи
			'new_item'           => 'New flat', // текст новой записи
			'view_item'          => 'View flat', // для просмотра записи этого типа.
			'search_items'       => 'Search flats', // для поиска по этим типам записи
			'not_found'          => 'Not found', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Not found in trash', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'flats', // название меню
		),
		'description'         => '',
		'public'              => true,
		'menu_position'       => null,
		'menu_icon'           => null, 
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => array('title'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	) );
}

add_action('init', 'create_taxonomy');
function create_taxonomy(){

	register_taxonomy('company', array('house'), array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => array(
			'name'              => 'company',
			'singular_name'     => 'company',
			'search_items'      => 'Search company',
			'all_items'         => 'All companys',
			'view_item '        => 'View company',
			// 'parent_item'       => 'Parent Genre',
			// 'parent_item_colon' => 'Parent Genre:',
			'edit_item'         => 'Edit company',
			'update_item'       => 'Update company',
			'add_new_item'      => 'Add new company',
			'new_item_name'     => 'New company',
			// 'menu_name'         => 'Genre',
		),
		'description'           => '', // описание таксономии
		'public'                => true,
		'show_ui'               => true,
		'hierarchical'          => true,
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
	) );

	register_taxonomy('buildings', array('house'), array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => array(
			'name'              => 'buildings',
			'singular_name'     => 'buildings',
			'search_items'      => 'Search buildings',
			'all_items'         => 'All buildings',
			'view_item '        => 'View buildings',
			// 'parent_item'       => 'Parent Genre',
			// 'parent_item_colon' => 'Parent Genre:',
			'edit_item'         => 'Edit buildings',
			'update_item'       => 'Update buildings',
			'add_new_item'      => 'Add new buildings',
			'new_item_name'     => 'New buildings',
			// 'menu_name'         => 'Genre',
		),
		'description'           => '', // описание таксономии
		'public'                => true,
		'show_ui'               => true,
		'hierarchical'          => true,
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
	) );
}



function kama_pagenavi( $args = array(), $wp_query = null ){

	if( ! $wp_query ){
		wp_reset_query();
		global $wp_query;
	}

	// параметры по умолчанию
	$default = array(
		'before'          => '',   // Текст до навигации.
		'after'           => '',   // Текст после навигации.
		'echo'            => true, // Возвращать или выводить результат.

		'text_num_page'   => '',           // Текст перед пагинацией.
										   // {current} - текущая.
										   // {last} - последняя (пр: 'Страница {current} из {last}' получим: "Страница 4 из 60").
		'num_pages'       => 4,           // Сколько ссылок показывать.
		'step_link'       => 10,           // Ссылки с шагом (если 10, то: 1,2,3...10,20,30. Ставим 0, если такие ссылки не нужны.
		'dotright_text'   => '…',          // Промежуточный текст "до".
		'dotright_text2'  => '…',          // Промежуточный текст "после".
		'back_text'       => 0,    // Текст "перейти на предыдущую страницу". Ставим 0, если эта ссылка не нужна.
		'next_text'       => 0,   // Текст "перейти на следующую страницу".  Ставим 0, если эта ссылка не нужна.
		'first_page_text' => 0, // Текст "к первой странице".    Ставим 0, если вместо текста нужно показать номер страницы.
		'last_page_text'  => 0,  // Текст "к последней странице". Ставим 0, если вместо текста нужно показать номер страницы.
	);

	// Cовместимость с v2.5: kama_pagenavi( $before = '', $after = '', $echo = true, $args = array() )
	if( func_num_args() && is_string( func_get_arg(0) ) ){
		$default['before'] = func_get_arg(0);
		$default['after']  = func_get_arg(1);
		$default['echo']   = func_get_arg(2);
	}

	$default = apply_filters( 'kama_pagenavi_args', $default ); // чтобы можно было установить свои значения по умолчанию

	$rg = (object) array_merge( $default, $args );

	//$posts_per_page = (int) $wp_query->get('posts_per_page');
	$paged          = (int) $wp_query->get('paged');
	$max_page       = $wp_query->max_num_pages;

	// проверка на надобность в навигации
	if( $max_page <= 1 )
		return false;

	if( empty( $paged ) || $paged == 0 )
		$paged = 1;

	$pages_to_show = intval( $rg->num_pages );
	$pages_to_show_minus_1 = $pages_to_show-1;

	$half_page_start = floor( $pages_to_show_minus_1/2 ); // сколько ссылок до текущей страницы
	$half_page_end   = ceil(  $pages_to_show_minus_1/2 ); // сколько ссылок после текущей страницы

	$start_page = $paged - $half_page_start; // первая страница
	$end_page   = $paged + $half_page_end;   // последняя страница (условно)

	if( $start_page <= 0 )
		$start_page = 1;
	if( ($end_page - $start_page) != $pages_to_show_minus_1 )
		$end_page = $start_page + $pages_to_show_minus_1;
	if( $end_page > $max_page ) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = (int) $max_page;
	}

	if( $start_page <= 0 )
		$start_page = 1;

	$out = '';

	// создаем базу чтобы вызвать get_pagenum_link один раз
	$link_base = str_replace( 99999999, '___', get_pagenum_link( 99999999 ) );
	$first_url = get_pagenum_link( 1 );
	if( false === strpos( $first_url, '?') )
		$first_url = user_trailingslashit( $first_url );

	$out .= '<div class="wp-pagenavi">'."\n";

		if( $rg->text_num_page ){
			$rg->text_num_page = preg_replace( '!{current}|{last}!', '%s', $rg->text_num_page );
			$out.= sprintf( "<span class='pages'>$rg->text_num_page</span> ", $paged, $max_page );
		}
		// назад
		if ( $rg->back_text && $paged != 1 )
			$out .= '<a class="prev" href="'. ( ($paged-1)==1 ? $first_url : str_replace( '___', ($paged-1), $link_base ) ) .'">'. $rg->back_text .'</a> ';
		// в начало
		if ( $start_page >= 2 && $pages_to_show < $max_page ) {
			$out.= '<a class="first" href="'. $first_url .'">'. ( $rg->first_page_text ?: 1 ) .'</a> ';
			if( $rg->dotright_text && $start_page != 2 ) $out .= '<span class="extend">'. $rg->dotright_text .'</span> ';
		}
		// пагинация
		for( $i = $start_page; $i <= $end_page; $i++ ) {
			if( $i == $paged )
				$out .= '<span class="current">'.$i.'</span> ';
			elseif( $i == 1 )
				$out .= '<a href="'. $first_url .'">1</a> ';
			else
				$out .= '<a href="'. str_replace( '___', $i, $link_base ) .'">'. $i .'</a> ';
		}

		// ссылки с шагом
		$dd = 0;
		if ( $rg->step_link && $end_page < $max_page ){
			for( $i = $end_page + 1; $i <= $max_page; $i++ ){
				if( $i % $rg->step_link == 0 && $i !== $rg->num_pages ) {
					if ( ++$dd == 1 )
						$out.= '<span class="extend">'. $rg->dotright_text2 .'</span> ';
					$out.= '<a href="'. str_replace( '___', $i, $link_base ) .'">'. $i .'</a> ';
				}
			}
		}
		// в конец
		if ( $end_page < $max_page ) {
			if( $rg->dotright_text && $end_page != ($max_page-1) )
				$out.= '<span class="extend">'. $rg->dotright_text2 .'</span> ';
			$out.= '<a class="last" href="'. str_replace( '___', $max_page, $link_base ) .'">'. ( $rg->last_page_text ?: $max_page ) .'</a> ';
		}
		// вперед
		if ( $rg->next_text && $paged != $end_page )
			$out.= '<a class="next" href="'. str_replace( '___', ($paged+1), $link_base ) .'">'. $rg->next_text .'</a> ';

	$out .= '</div>';

	$out = apply_filters( 'kama_pagenavi', $rg->before . $out . $rg->after );

	if( $rg->echo )
		echo $out;
	else
		return $out;
}
