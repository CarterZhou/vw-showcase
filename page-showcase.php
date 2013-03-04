<?php
/*
Template Name: Showcase Page
*/
?>
<?php
/*
 * Author: Hao Zhou
 * Date: 23/01/2013 
 * This php snippet is dedicated to implementing fastBREAK/Change Media Video Showcase.
 */
function getInfo($all_info){
	$info = array();
	$subjects = array_keys($all_info);
	$subject = $_POST['subject'];
	if (in_array($subject, $subjects)) {
		if(!empty($all_info[$subject])){
			$info['topic'] = $subject;
			$info['speakers'] = $all_info[$subject]['speakers'];
			$info['date'] = $all_info[$subject]['date'];
			$info['intro'] = $all_info[$subject]['intro'];
			$info['review_link'] = $all_info[$subject]['review_link'];
		}
		echo json_encode($info);
	}
	die();
}
	

function getVideoLinks(){
	$params  = func_get_args();
	$all_info = $params[0];
	$urls = array();
	$subjects = array_keys($all_info);
	$subject = $_POST['subject'];
	if (in_array($subject, $subjects)) {
		if(!empty($all_info[$subject])){
			for ($i=1; $i < count($params); $i++) { 
				$urls[$params[$i]] = $all_info[$subject][$params[$i]];
			}
		}
		echo json_encode($urls);
	}
	die();
}

if (isset($_POST['subject']) && $_POST['subject']!='') {
	$fastbreak_info = array(
						'u-turn' =>  
							array(
								'date'=> '24 February 2012',
								'review_link' => 'http://vibewire.org/2012/02/fastbreak-u-turn-review/',
								'urls' => 
									array(
									'http://www.youtube.com/embed/vqGGrImW0b4',
									'http://www.youtube.com/embed/cSOl3LJ6dhk',
									'http://www.youtube.com/embed/qzOKYqBNmWU',
									'http://www.youtube.com/embed/6TXv_XLAzcI',
									'http://www.youtube.com/embed/XvFT93fgPEo',
									),
								'speakers'=>
									array(
										'Monica Kade',
										'Philip Gomes',
										'Robert Beson',
										'Ralph Hobbs',
										'Katherine Tu'
									),
								'intro' =>'A crowd gathered underneath planes of a by-gone era and braved the early morning.
								A large black steam engine, a glossy burgundy tram carriage and a number of other vintage cars, all suspended in time, surrounded attendees at the Powerhouse Museum.
								With these relics from the past, it was a fitting place for five diverse speakers to explain how they had a U-Turn\' in their lives and give advice to the crowd on how to tackle the future.'
							),

						'play' => 
							array(
								'date'=> '30 March 2012',
								'review_link' => 'http://vibewire.org/2012/04/fastbreak-play-review-2/',
								'urls'=>array(
									'http://www.youtube.com/embed/NH8GhTC1cN0',
									'http://www.youtube.com/embed/lQm2Eroozjw',
									'http://www.youtube.com/embed/c7_Syy26cQE',
									'http://www.youtube.com/embed/u-JL7uJ4gnE',
									'http://www.youtube.com/embed/8vf_nEiiJ5c'
									),
								'speakers'=>
									array(
										'Gavin Smith',
										'Flutter Lyon',
										'Ben Rennie',
										'Lisa O\'Brien',
										'Michael Scholz'
									),
								'intro' =>'The young at heart met at our monthly fastBREAK event to hear stories of fun, play, and how to keep imaginations running wild when maturity, a career and commitments come knocking at the door.'
							),

						'rage' =>
							array(
								'date' => '27 April 2012',
								'review_link' => 'http://vibewire.org/2012/04/fastbreak-rage-review/',
								'urls' => array(
									'http://www.youtube.com/embed/ujgc0MLDxts',
									'http://www.youtube.com/embed/2cRfBR3_Xks',
									'http://www.youtube.com/embed/si0NIQ-0sRM',
									'http://www.youtube.com/embed/a5ApZdYVZ3Y',
									'http://www.youtube.com/embed/PVYP0eTDctQ'
								),
								'speakers'=>
									array(
										'Dan Ilic',
										'Jeroen van Kernebeek',
										'Rami Mandow',
										'Allison Baker',
										'Sheron Sultan'
									),
								'intro' =>'Rage captivated its morning audience, as bleary eyes and tired yawns gave way to inspring speakers compelling their audience to channel personal rage into something positive.
								The speakers dispelled the negative undertones associated with rage, suggesting rather that rage is a catalyst for action.'
							),
						

						'epic' => 
							array(
								'date' => '18 May 2012',
								'review_link' => 'http://vibewire.org/2012/05/fastbreak-epic-review/',
								'urls' => array(
									'http://www.youtube.com/embed/7WRS6P9yJfk',
									'http://www.youtube.com/embed/lVb6-qz5P5I',
									'http://www.youtube.com/embed/mga81Y45KqU',
									'http://www.youtube.com/embed/irfyUhP1mVc',
									'http://www.youtube.com/embed/KGxpGLULqaU'
								),
								'speakers'=>
									array(
										'Kate Middleton',
										'Dr. Avnesh Ratnanesan',
										'Joshua Capelin',
										'Catherine Keenan',
										'Kate Anderson'
									),
								'intro' =>'Epic truly lived up to its name as our passionate speakers took to the stage and discussed their own epic eureka moments. It proved a compelling insight into the creative processes involved in embarking on a new project. And reminded the audience that our ideas can shape the world around us, but only if we nurture them.'
								),
						

						'stuffed' =>
							array(
								'date' => '29 June 2012',
								'review_link' => 'http://vibewire.org/2012/06/fastbreak-stuffed-2/',
								'urls' => array(
									'http://www.youtube.com/embed/8EOycwTI6ss',
									'http://www.youtube.com/embed/NC5Bw0wJPX0',
									'http://www.youtube.com/embed/dQfe6pJpKT0',
									'http://www.youtube.com/embed/gB1IXM7o7XQ',
									'http://www.youtube.com/embed/gJeiyTd-BC4'
								),
								'speakers'=>
									array(
										'Marita Cheng',
										'Luke Geary',
										'Clover Moore',
										'Annalie Killian',
										'Nic Newling'
									),
								'intro' =>'This month\'s fastBREAK: Stuffed served as a welcomed replacement for the conventional cup of hot coffee. Energy kicks and wide-eyes came from thought provoking ideas that explored how stuffed doesn\'t simply mean a dead-end result for everyone. Rather, it can inspire positive change.'
							),
						
						'lies' =>
							array(
								'date' => '27 July 2012',
								'review_link' => 'http://vibewire.org/2012/07/fastbreak-lies-review/',
								'urls' => array(
									'http://www.youtube.com/embed/7eXiHsSVBOg',
									'http://www.youtube.com/embed/H64rAUE91t4',
									'http://www.youtube.com/embed/RXzLUrbakbw',
									'http://www.youtube.com/embed/vZLTaJLjokk',
									'http://www.youtube.com/embed/C4GL1r3b2yo'
								),
								'speakers'=>
									array(
										'Hannah Law',
										'Tim Burrows',
										'Jack Hilton',
										'Dev Singh',
										'Simon Cant'
									),
								'intro' =>'This month\'s fastBREAK: Lies was an engaging look at deception. Early risers were treated with five individual stories about the nature of lying and how it seeps into every day life.'
							),
						

						'danger' =>
							array(
								'date' => '24 August 2012',
								'review_link' => 'http://vibewire.org/2012/08/fastbreak-danger-review/',
								'urls' => array(
									'http://www.youtube.com/embed/lB4rwRWGBrM',
									'http://www.youtube.com/embed/u6lI4SLieBw',
									'http://www.youtube.com/embed/7foovsFCIvk',
									'http://www.youtube.com/embed/O6VkxMhv3xs'
								),
								'speakers'=>
									array(
										'Wendy Zuckerman',
										'Lisa Harvey Smith',
										'Daniel Keogh',
										'Dr Michael Biercuk'
									),
								'intro' =>'We live in a society abuzz with the sound of high tech gadgets. We live in a society where news of recent scientific discoveries and technological progress have filtered into the conversations of the everyday. From the discovery of the Higgs-Boson particle to the launch of NASA\'s Curiosity\' rover, science has become the talk of the town.
								This month\'s fastBREAK speakers joined the discussion with the full force of scientific curiosity and inquisitiveness. The speakers engaged in questioning the dangers of science, provoking deep thought yet drawing laughter from their audience.'
							), 
						
						'cure' =>
							array(
								'date' => '28 September 2012',
								'review_link' => 'http://vibewire.org/2012/09/fastbreak-cure-review/',
								'urls' => array(
										'http://www.youtube.com/embed/3eV_2gzts1w',
										'http://www.youtube.com/embed/JXRv7N6R4Do',
										'http://www.youtube.com/embed/bqZMTqwuCDE',
										'http://www.youtube.com/embed/uVl13-pJV2c',
										'http://www.youtube.com/embed/SK-XBYJ_nOQ',
										'http://www.youtube.com/embed/Xgby5rfjjk0'
										),
								'speakers'=>array(
										'Seema Duggal',
										'Scott Brown',
										'Nathaniel Smith',
										'Giverny Lewis',
										'Jamie Moore',
										'Ellie Webster'
									),
								'intro' =>'It\'s human nature to want to fix what we perceive as broken. This was the underlying theme of this month\'s fastBREAK, where six passionate speakers discussed creative cures for society\'s shortcomings.'
								),

						'tasty' => 
							array(
								'date' => '26 October 2012',
								'review_link' => '',
								'urls' => array(
										'http://www.youtube.com/embed/1M_Fbui8LFQ',
										'http://www.youtube.com/embed/PxopBVlYHWg',
										'http://www.youtube.com/embed/WVxrqouxF94',
										'http://www.youtube.com/embed/zOJvk9q8Q7E'
										),
								'speakers'=>array(
										'Alex Adams',
										'Marko Iljadica',
										'Costa Geordiadis',
										'Dana Cordell'
									),
								'intro' => 'Fill your fastBREAK appetite this month with \'Tasty\' talks coming from home-grown specialists and also an overseas special guest!

								Tasty is all things food and will delve into the reasons why we eat as well as what we eat. The things we do to get food in this modern day and age are remarkable, whether it be importing goods from overseas, or having massive plantations that the everyday person hasn\'t even considered.
								
								Sometimes we need to slow down and enjoy what we\'ve really got. Come and celebrate and talk seriously about food and enjoy the delights of every fastBREAK.'
								),

						'magic' => 
							array(
								'date' => '30 November 2012',
								'review_link' => '',
								'urls' => array(
										'http://www.youtube.com/embed/HEETaNolosU',
										'http://www.youtube.com/embed/jIEVVrghSxs',
										'http://www.youtube.com/embed/NwCrIPCHlUU',
										'http://www.youtube.com/embed/GTm4UEOsXsI'
										),
								'speakers'=>array(
										'Lizza Gebilagin',
										'Ehon Chan',
										'Danielle Lauren',
										'Jess Scully'
									),
								'intro'=>'fastBREAK this month brings together a series of creatives and who have had varied experiences in the fields they have worked, the lives they have led and the world they wish to be apart of.

								Magic can be deceptive or it can be the way the world is seen. To those who are oblivious to the details, it can sometimes be mysterious or supernatural. For those in the know, it can boil down to be a simple parlour trick. As a child, many things seem almost magical because of the lack of explanation. As adults we uncover the truths about how the world works.

								To think creatively allows each individual to see the world in a different light and the speakers this month all have a very unique perspective. Seeing something old in a new way can really help.

								This month at fastBREAK: Magic come and see what this year\'s series has come to create.'
								),
						
						'do as you are told' => 
							array(
								'date' => 'November 2011',
								'review_link' => '',
								'urls' => array(
										'http://www.youtube.com/embed/e4RCJEU1a6w'
										),
								'speakers'=>array(
										'Jacquie Hoyes'
									),
								'intro'=>''
								),

						'better together' => 
							array(
								'date' => 'September 2011',
								'review_link' => '',
								'urls' => array(
										'http://www.youtube.com/embed/1_nFQbGZ8CI',
										'http://www.youtube.com/embed/2YGujccRv0U',
										'http://www.youtube.com/embed/GrE8yCdRP94',
										'http://www.youtube.com/embed/h8Q1MXgJVyY',
										'http://www.youtube.com/embed/YM2c6kHi4D0'
										),
								'speakers'=>array(
										'The Fortynine',
										'Gavin Artz',
										'Greedy Hen',
										'Doug Millen',
										'Ruchir Punjabi'
									),
								'intro'=>''
							),

						'why do you care' => 
							array(
								'date' => 'August 2011',
								'review_link' => '',
								'urls' => array(
										'http://www.youtube.com/embed/2oJYTGerw8g',
										'http://www.youtube.com/embed/sJMFP-cPNLY',
										'http://www.youtube.com/embed/e9t--QE_fzg',
										'http://www.youtube.com/embed/OAjegXHZUME',
										'http://www.youtube.com/embed/i5kJnGqmmHo'
										),
								'speakers'=>array(
										'Erika Taylor',
										'Neeraj Sharma',
										'Mia Sharma',
										'Peter Macreadie',
										'Dominic Hare'
									),
								'intro'=>''
							),

						'is old new again' => 
							array(
								'date' => 'July 2011',
								'review_link' => '',
								'urls' => array(
										'http://www.youtube.com/embed/wX5JwAvyW4I',
										'http://www.youtube.com/embed/hWGeqWTzhbk',
										'http://www.youtube.com/embed/zYa-WHYS-JY',
										'http://www.youtube.com/embed/PS7tIHp7dUk'
										),
								'speakers'=>array(
										'Diego Bonetto',
										'Mathieu Gallois',
										'Darryl Nichols',
										'Amanda Talbot'
									),
								'intro'=>''
							),

						'what turns you on' => 
							array(
								'date' => 'June 2011',
								'review_link' => '',
								'urls' => array(
										'http://www.youtube.com/embed/56sE6iDYGKo',
										'http://www.youtube.com/embed/Hie9l9S22ec',
										'http://www.youtube.com/embed/jH4Ldo8Lzzw',
										'http://www.youtube.com/embed/gyChjr5dpYE',
										'http://www.youtube.com/embed/nwUanNIvj0I'
										),
								'speakers'=>array(
										'Catherine Alcorn',
										'Alan Crabbe',
										'Eddie Sharp',
										'Elizabeth White & Robert Moorman',
										'Willurei Kirkbright'
									),
								'intro'=>''
							),

						'what is stopping you' => 
							array(
								'date' => 'March 2011',
								'review_link' => '',
								'urls' => array(
										'http://www.youtube.com/embed/l-7L0o-gw5U',
										'http://www.youtube.com/embed/txYfY06IRck',
										'http://www.youtube.com/embed/atg_M1l9QPM',
										'http://www.youtube.com/embed/RnIufybweBg',
										'http://www.youtube.com/embed/Cim2tzI2DS4'
										),
								'speakers'=>array(
										'Zoe Lamont',
										'Courtney Tight',
										'Leanne Townsend',
										'Alicia Freile',
										'Louise Helliwell & Alex DeBonnis'
									),
								'intro'=>''
							),

						'power' => 
							array(
								'date' => 'September 2010',
								'review_link' => '',
								'urls' => array(
										'http://www.youtube.com/embed/veXVq9YhII4',
										'http://www.youtube.com/embed/nUTwLfkyCKQ',
										'http://www.youtube.com/embed/09_z6EdduTI',
										'http://www.youtube.com/embed/lMPcqKKIsPA',
										'http://www.youtube.com/embed/Cim2tzI2DS4'
										),
								'speakers'=>array(
										'Lilly McComb',
										'Ant McPhail',
										'Vanessa Cullen',
										'Jenni Illoski',
										'Louise Helliwell & Alex DeBonnis'
									),
								'intro'=>''
							),

						'are you ready' => 
							array(
								'date' => 'March 2010',
								'review_link' => '',
								'urls' => array(
										'http://www.youtube.com/embed/kVAqX3xl_8Y',
										'http://www.youtube.com/embed/QN1ooGJkF70'
										),
								'speakers'=>array(
										'Scott Drummond',
										'Monique Schafter'
									),
								'intro'=>''
							),

						'love' => 
							array(
								'date' => 'November 2010',
								'review_link' => '',
								'urls' => array(
										'http://www.youtube.com/embed/X0J8DwBvNys',
										'http://www.youtube.com/embed/V5MD1yoFMho',
										'http://www.youtube.com/embed/vpMr6ZBHQ7Q',
										'http://www.youtube.com/embed/_OalCShhcTE',
										'http://www.youtube.com/embed/7tDKG8rXKUk'
										),
								'speakers'=>array(
										'Chris Thé',
										'Jono Fisher',
										'Luke Escombe',
										'Rai Santana',
										'Meggan Grose'
									),
								'intro'=>''
							),

						'what matters' => 
							array(
								'date' => 'February 2010',
								'review_link' => '',
								'urls' => array(
										'http://www.youtube.com/embed/EOMttXhBhhI',
										'http://www.youtube.com/embed/7FWtgciYQxo'
										),
								'speakers'=>array(
										'Michael Fox',
										'Matt Huynh'
									),
								'intro'=>''
							),

						'things change' => 
							array(
								'date' => 'August 2010',
								'review_link' => '',
								'urls' => array(
										'http://www.youtube.com/embed/ExMQhG3M9X8',
										'http://www.youtube.com/embed/Ye0RFzJWiy0'
										),
								'speakers'=>array(
										'Wendy Yeung',
										'Sam Strong'
									),
								'intro'=>''
							)
					);

	$changemedia_info = array(
							'mental-health'=>
							array(
								'thumbnails'=>array('http://vibewire.org/wp-content/uploads/2013/02/mental-health.jpg'),
								'intros'=>array('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
								'urls'=>array('http://www.youtube.com/embed/g4zVW4Ar0Qk')
								),
							'indigenous-youth'=>
							array(
								'thumbnails'=>array('http://vibewire.org/wp-content/uploads/2013/02/youth.jpg'),
								'intros'=>array('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
								'urls'=>array('http://www.youtube.com/embed/etrvQB6Tvj0')
								),
							'religion'=>
							array(),
							'politics'=>
							array(),
							'science-technology'=>
							array(),
							'lgbtiq'=>
							array(
								'thumbnails'=>
									array(
										'http://vibewire.org/wp-content/uploads/2013/02/lgbtiq.jpg',
										'http://vibewire.org/wp-content/uploads/2013/02/lgbtiq2.jpg'
									),
								'intros'=>
									array(
									'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
									'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
									),
								'urls'=>
									array(
										'http://www.youtube.com/embed/DKmX4_HvPa0',
										'http://www.youtube.com/embed/sITN9zBSie4'
									)
								),
							'health'=>
							array(),
							'social-justice'=>
							array(),
							'race-culture'=>
							array(),
							'environment'=>
							array(),
							'education'=>
							array()
						);

	if (isset($_POST['type'])) {
		if($_POST['type'] == 'fb'){
			getVideoLinks($fastbreak_info,'urls','review_link','speakers');
		}else if($_POST['type'] == 'cm'){
			getVideoLinks($changemedia_info,'thumbnails','urls','intros');
		}
	}else{
		getInfo($fastbreak_info);
	}

}
?>
<?php get_header(); ?>
<div id="mainwrapper">  
<?php while ( have_posts() ) : the_post(); ?>
	<?php the_content(); ?>
<?php endwhile;?>    
</div>
<?php get_footer(); ?>
<script type="text/javascript">
$('document').ready(function(){
	$('#mainwrapper').css('background-color','black');
	$('.team-profile-heading').css({'color':'#fff','margin-left':'49px'});
});
</script>