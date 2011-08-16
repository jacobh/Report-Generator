		<div class="form_fields">
			<label>Safety Precautions</label>
			<textarea name="data[safety_precautions]"><?php if($data['safety_precautions']): h($data['safety_precautions']) ?><?php else: ?>All damp proofing and timber treatment materials present some form of hazard but we will always strive to use the least hazardous materials available for the benefit of our clients and staff. Our operatives have been trained in the use of the materials that they work with and will take the necessary precautions. The hazard posed by our activities is insignificant provided the following safety precautions are followed by all who enter a property or area where treatment has taken place.
				<?php endif; ?>
			</textarea>
		
			<label>The Don'ts</label>
			<textarea name="data[donts]"><?php if($data['donts']): h($data['donts']) ?><?php else: ?>1. DO NOT enter an area whilst treatment is taking place.
2. DO NOT smoke, use naked lights, electric fires or other similar heating appliances in the treated areas for a minimum of 8 hours after treatment. During this period ventilate the areas thoroughly.
3. DO NOT enter, eat, drink or sleep in treated rooms for at least 8 hours following treatment.
4. DO NOT allow children or pets to walk across treated floors until the timbers are dry or the floors are covered.
5. DO NOT lay floor coverings on to newly treated floors for a minimum of one week. Vinyl and foam back carpet should not be directly laid on to floors for at least four weeks following treatment if any solvent based material was used.
				<?php endif; ?></textarea>
		
			<label>The Do's</label>
			<textarea name="data[dos]"><?php if($data['dos']): h($data['dos']) ?><?php else: ?>1. DO warn your plumber, central heating contractor, electrician etc, of these precautions especially if a blow lamp it to be used in the vicinity of treatment.
2. DO keep fish and caged birds out of treated areas until all vapours have dispersed.
3. DO remove foodstuffs from areas of proposed treatment and do not re-introduce until 48 hours after treatment of such areas.
4. DO remove any clothing accidentally contaminated and wash affected skin and hair thoroughly.
5. DO inform us of any cavity wall insulation which you may have had installed in walls to be treated for rising damp.
6. DO inform us before treatment if you know of anybody who has a respiratory problem in your property or an attached adjoining property.
				<?php endif; ?>
			</textarea>
		</div>