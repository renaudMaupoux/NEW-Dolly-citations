<?php
/*
Plugin Name: Citations citations...
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
Author: des_citations M
Version: 1.0
*/

function des_citations_get_lyric() {

	$lyrics = "La vie, c'est comme une bicyclette, il faut avancer pour ne pas perdre l'équilibre.
	Pour critiquer les gens il faut les connaître, et pour les connaître, il faut les aimer.
	Choisissez un travail que vous aimez et vous n'aurez pas à travailler un seul jour de votre vie.
	Un seul être vous manque et tout est dépeuplé.
	La nature fait les hommes semblables, la vie les rend différents.
	Plus l'espérance est grande, plus la déception est violente.
	Les folies sont les seules choses qu'on ne regrette jamais.
	Les portes de l'avenir sont ouvertes à ceux qui savent les pousser.
	Tout ce que je sais, c'est que je ne sais rien.";

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
    return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}


// This just echoes the chosen line, we'll position it later.
function des_citations() {
	$chosen = des_citations_get_lyric();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="dolly"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__( 'Quote from Sherlock des_citations', 'hello-dolly' ),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'des_citations' );

// We need some CSS to position the paragraph.
function des_citations_css() {
	echo "
	<style type='text/css'>
	#dolly {
		float: right;
		padding: 5px 10px;
		margin: 0;
		color:#FFF;
		font-size: 16px;
		line-height: 1.6666;
		background: linear-gradient(90deg,#e66465, #9198e5);
		border-radius:1.2em;
		padding: .5em 2em;
	}
	.rtl #dolly {
		float: left;
	}
	.block-editor-page #dolly {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#dolly,
		.rtl #dolly {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'des_citations_css' );
