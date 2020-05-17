<div class="modal fade" id="math-editor-modal" tabindex="-1" role="dialog" aria-labelby="getCodeLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		        	<span aria-hidden="true" class="nsicon nsicon-close-button"></span>
		        </button>
		        <h3 class="modal-title">Math Editor</h3>
      		</div>
 			
 			<div class="modal-body">

 				<div id="math-options">
 					<div data-id="exponents" class="symbols-type symbols-in-view ns-button btn-negate grey-btn">Exponents</div>
					<div data-id="operators" class="symbols-type ns-button btn-negate grey-btn">Operators</div>
					<div data-id="brackets" class="symbols-type ns-button btn-negate grey-btn">Brackets</div>
					<div data-id="arrows" class="symbols-type ns-button btn-negate grey-btn">Arrows</div>
					<div data-id="relational" class="symbols-type ns-button btn-negate grey-btn">Relational</div>
					<div data-id="sets" class="symbols-type ns-button btn-negate grey-btn">Sets</div>
					<div data-id="greek" class="symbols-type ns-button btn-negate grey-btn">Greek</div>
					<div data-id="advanced" class="symbols-type ns-button btn-negate grey-btn">Advanced</div>

					<!-- Exponents -->
					<div class="symbols-type-options" id="exponents" style="display: block">
						<?php require_once( dirname(__FILE__) . '/latex-symbols/exponents.php' );
						foreach( $exponents as $item ) { ?>
							<div class="symbol medium-icon" data-tex="<?php echo esc_html( $item ); ?>" aria-label="<?php echo esc_html( $item ); ?>" title="<?php echo esc_html( $item ); ?>">
								<?php echo "\(" . esc_html( $item ) ."\)"; ?>
							</div>
						<?php } ?>
					</div>

					<!-- Operators -->
					<div class="symbols-type-options" id="operators">
						<?php require_once( dirname(__FILE__) . '/latex-symbols/operators.php' );
						foreach( $operators as $item ) { ?>
							<div class="symbol small-icon" data-tex="<?php echo esc_html( $item ); ?>" aria-label="<?php echo esc_html( $item ); ?>" title="<?php echo esc_html( $item ); ?>">
								<?php echo "\(" . esc_html( $item ) ."\)"; ?>
							</div>
						<?php } ?>
					</div>
					
					<!-- Brackets -->
					<div class="symbols-type-options" id="brackets">
						<?php require_once( dirname(__FILE__) . '/latex-symbols/brackets.php' );
						foreach( $brackets as $item ) { ?>
							<div class="symbol medium-icon" data-tex="<?php echo esc_html( $item ); ?>" aria-label="<?php echo esc_html( $item ); ?>" title="<?php echo esc_html( $item ); ?>">
								<?php echo "\(" . esc_html( $item ) ."\)"; ?>
							</div>
						<?php } ?>
					</div>

					<!-- Arrows -->
					<div class="symbols-type-options" id="arrows">
						<?php require_once( dirname(__FILE__) . '/latex-symbols/arrows.php' );
						foreach( $arrows as $item ) { ?>
							<div class="symbol" data-tex="<?php echo esc_html( $item ); ?>" aria-label="<?php echo esc_html( $item ); ?>" title="<?php echo esc_html( $item ); ?>">
								<?php echo "\(" . esc_html( $item ) ."\)"; ?>
							</div>
						<?php } ?>
					</div>

					<!-- Relational -->
					<div class="symbols-type-options" id="relational">
						<?php require_once( dirname(__FILE__) . '/latex-symbols/relational.php' );
						foreach( $relational as $item ) { ?>
							<div class="symbol" data-tex="<?php echo esc_html( $item ); ?>" aria-label="<?php echo esc_html( $item ); ?>" title="<?php echo esc_html( $item ); ?>">
								<?php echo "\(" . esc_html( $item ) ."\)"; ?>
							</div>
						<?php } ?>
					</div>

					<!-- Sets -->
					<div class="symbols-type-options" id="sets">
						<?php require_once( dirname(__FILE__) . '/latex-symbols/sets.php' );
						foreach( $sets as $item ) { ?>
							<div class="symbol small-icon" data-tex="<?php echo esc_html( $item ); ?>" aria-label="<?php echo esc_html( $item ); ?>" title="<?php echo esc_html( $item ); ?>">
								<?php echo "\(" . esc_html( $item ) ."\)"; ?>
							</div>
						<?php } ?>
					</div>

					<!-- Greek -->
					<div class="symbols-type-options" id="greek">
						<?php require_once( dirname(__FILE__) . '/latex-symbols/greek.php' );
						foreach( $greek as $item ) { ?>
							<div class="symbol small-icon" data-tex="<?php echo esc_html( $item ); ?>" aria-label="<?php echo esc_html( $item ); ?>" title="<?php echo esc_html( $item ); ?>">
								<?php echo "\(" . esc_html( $item ) ."\)"; ?>
							</div>
						<?php } ?>
					</div>

					<!-- Calculus -->
					<div class="symbols-type-options" id="advanced">
						<?php require_once( dirname(__FILE__) . '/latex-symbols/advanced.php' );
						foreach( $advanced as $item ) { ?>
							<div class="symbol large-icon" data-tex="<?php echo esc_html( $item ); ?>" aria-label="<?php echo esc_html( $item ); ?>" title="<?php echo esc_html( $item ); ?>">
								<?php echo "\(" . esc_html( $item ) ."\)"; ?>
							</div>
						<?php } ?>
					</div>

					<!-- Using Image Files -->
					<?php /* <div class="symbols-type-options" id="operators" style="display: block">
						<?php require_once( dirname(__FILE__) . '/latex-symbols/operators/symbols.php' );
						foreach( $operators as $file => $item ) {
							$size = getimagesize( plugins_url('/latex-symbols/operators/', __FILE__) . $file ); ?>
							<div class="icon-symbol" data-tex="<?php echo esc_html( $item[0] ); ?>" aria-label="<?php echo esc_html( $item[0] ); ?>" title="<?php echo esc_html( $item[0] ); ?>">
								<img src="<?php echo plugins_url('/latex-symbols/operators/', __FILE__) . $file; ?>"<?php echo $size[0] > 20 ? ' width="15px"' : ''; echo $size[1] > 20 ? ' height="15px"' : ''; ?>>
							</div>
						<?php } ?>
					</div> */ ?>
					
				</div>

				<div style="margin-top: 20px">
					<label for="math-editor-textarea">Edit math using TeX:</label>
					<textarea class="equation-textarea form-control" id="math-editor-textarea" rows="5" spellcheck="false"></textarea>
				</div>

				<div style="margin-top: 20px">
					<label for="math-equation-preview">Math preview:</label>
					<div class="equation-preview table-responsive" id="math-equation-preview"></div>
				</div>

			</div>

			<div class="modal-footer">
				<div class="pull-right">
					<button type="button" class="ns-button btn-negate" class="close" data-dismiss="modal" aria-label="Close">Close</button>
					<button type="button" class="ns-button" id="insert_math" style="margin-left:10px">Insert Math</button>
				</div>
			</div>
      
    	</div>
  	</div>
</div>