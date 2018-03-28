<div class="page-header">
	<div class="filtro">
		<?php echo form_open('analise/importar','id="form-ga-filtro"'); ?>
			<div class="campos">
				<?php if($this->uri->segment(2) != 'importar'): ?>
					<div class="profiles">
						<label for="profileId">Profile</label>
						<select id="profileId" name="profileId">
							<option value="0">Selecione um perfil...</option>
						<?php
						foreach ($aProfiles as $sKey => $sValue) {
							$selected = '';
							if($sKey == $selectedProfile) {
								$selected = 'selected';
								$profileName = $sValue;
							}
							echo '<option '.$selected.' value="' . $sKey . '">' . $sValue . '</option>';
						}
						?>
						</select>
					</div>
				<?php else: ?>
					<h1>Selecione o intervalo de datas para importação</h1>				
				<?php endif; ?>
				<div class="dates">
					<label for="from">From</label>
					<input type="text" id="from" name="from"/>
					<label for="to">to</label>
					<input type="text" id="to" name="to"/>						
				</div>
			</div>
			<div class="botoes">
				<input type="submit" id="submit" value="Submit">
			</div>
		<?php echo form_close(); ?>
	</div>
</div>