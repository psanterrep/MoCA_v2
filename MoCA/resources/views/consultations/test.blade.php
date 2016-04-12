@extends('layouts.app')
@section('head')
<script type="text/javascript" src="{{ URL::asset('lib/jsPsych-5.0.3/jspsych.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('lib/jsPsych-5.0.3/plugins/jspsych-text.js') }}"></script>
<link href="{{ asset('lib/spsych-5.0.3/jspsych.css') }}" rel="stylesheet">
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-body center-block">
					@include('errors.messages')
					<?= Form::token();?>
					<?= Form::hidden("consultation",$consultation->id);?>
					<?= Form::hidden("test",$test->id);?>
					<?php if (App::getLocale() == "en"): ?>
						Be sure to have Windows update disabled before taking this test
						<br/><br/>
						To disable your Windows update on Windows 10 						
						<ul>
							<li>1. Click on Start menu</li>
							<li>2. Click on "Settings"</li>
							<li>3. Click on "System"</li>
							<li>4. Click on "Notification and Actions"</li>
							<li>5. Disable "Show advide on Windows"</li>
							<li>6. Disable "Show notification from applications"</li>
						</ul>
						<br/>
						To disable your Windows update on Windows 7
						<ul>
							<li>1. Click on "Start menu"</li>
							<li>2. Click on "All Programs"</li>
							<li>3. Click on "Windows Update"</li>
							<li>4. Click on "Edit Settings"</li>
							<li>5. Under the section "Important Upgrade", select the option "Never search for updates"</li>
						</ul>
						<br/>
						After the test, it's recommended to undo those modification
						<br/>
					<?php else: ?>
						Avant de comnmencer le test, soyez sur que vos notifications sont désactivé
						<br/><br/>
						Pour désactiver les notifications sur Windows 10
						<ul>
							<li>1. Cliquez sur le bouton "Démarrer"</li>
							<li>2. Cliquez sur le bouton "Paramètres"</li>
							<li>3. Cliquez sur le bouton "Systèmes"</li>
							<li>4. Cliquez sur le bouton "Notifications et sctions"</li>
							<li>5. Désactiver l'option "Afficher des conseils sur Widnows"</li>
							<li>5. Désactiver l'option "Afficher les notifications d'application"</li>
						</ul>
						<br/>
						Pour désactiver les notifications sur Windows 7
						<ul>
							<li>1. Cliquez sur le bouton "Démarrer"</li>
							<li>2. Cliquez sur "Tous les programmes"</li>
							<li>3. Cliquez sur "Windows Update"</li>
							<li>4. Dans le menu à gauche, cliquer sur "Modifier les paramètres"</li>
							<li>5. Sous "Mises à jour importantes", sélectionnez l'option "Ne jamais rechercher des mises à jour"</li>
							<li>6. Cliquez sur "OK"</li>
						</ul>
						<br/>
						Après le test, il est recommander de faire les étapes inverses.
						<br/>
					<?php endif ?>
					<div id="jspsych-target" class="psych_window"></div>
    				<?php include($test->getFullPath()); ?>
    				<div class="text-center"> 
						<button class="btn btn-primary" onclick="fullscreen();"><?= Lang::get('tests.start_test') ?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="{{ URL::asset('js/consultation.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('lib/screenfull.js') }}"></script>
@endsection 
