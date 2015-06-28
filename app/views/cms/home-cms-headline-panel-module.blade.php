@if (isset($headlineEntries) && isset($cmsHeadlineCategories) && isset($cmsHeadlineRensaiPosts) &&
	 isset($cmsHeadlineFeaturesPosts) && isset($cmsHeadlineNewsPosts) && isset($cmsHeadlineGadgetsPosts))
	{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/home'), 
				  'class' => '', 'accept-charset' => 'UTF-8']) }}		  
		<table id="cms-content-frame-home-headline-panel" class="cms-content-frame">
			<tr>
				<td class="left-col home-cms-panel-headline-leftcol">Select Category :</td>
				<td class="right-col home-cms-panel-headline-rightcol">
					<select id="entry-category">
						@foreach($cmsHeadlineCategories as $cmsHeadlineCategory)
							<option value="{{ $cmsHeadlineCategory }}" 
									<?php if(strtolower($thisHeadlinePageType) == strtolower($cmsHeadlineCategory)) { ?>selected<?php } ?>>
								{{ $cmsHeadlineCategory }}
							</option>
						@endforeach
					</select>
				</td>
			</tr>
			<tr>
				<td class="left-col home-cms-panel-headline-leftcol">Select Post :</td>
				<td class="right-col home-cms-panel-headline-rightcol">
					<select id="features-entry-post-options" class="longwidth" style="display:none;">
						@foreach($cmsHeadlineFeaturesPosts as $cmsHeadlineFeaturesPost)
							<option value="{{ 'Features ' . $cmsHeadlineFeaturesPost->id }}">
								[{{ $cmsHeadlineFeaturesPost->category_name }}]
								{{ mb_substr($cmsHeadlineFeaturesPost->post_title, 0, 20) . ' ...' }}
							</option>
						@endforeach
					</select>
					<select id="rensai-entry-post-options" class="longwidth" style="display:none;">
						@foreach($cmsHeadlineRensaiPosts as $cmsHeadlineRensaiPost)
							<option value="{{ 'Rensai ' . $cmsHeadlineRensaiPost->id }}">
								[{{ $cmsHeadlineRensaiPost->category_name }}]
								{{ mb_substr($cmsHeadlineRensaiPost->post_title, 0, 20) . ' ...' }}
							</option>
						@endforeach
					</select>
					<select id="news-entry-post-options" class="longwidth" style="display:none;">
						@foreach($cmsHeadlineNewsPosts as $cmsHeadlineNewsPost)
							<option value="{{ 'News ' . $cmsHeadlineNewsPost->id }}">
								{{ mb_substr($cmsHeadlineNewsPost->post_title, 0, 20) . ' ...' }}
							</option>
						@endforeach
					</select>
					<select id="gadgets-entry-post-options" class="longwidth" style="display:none;">	
						@foreach($cmsHeadlineGadgetsPosts as $cmsHeadlineGadgetsPost)
							<option value="{{ 'Gadgets ' . $cmsHeadlineGadgetsPost->id }}">
								No.{{ $cmsHeadlineGadgetsPost->id }}&nbsp;
								{{ mb_substr($cmsHeadlineGadgetsPost->post_title, 0, 20) . ' ...' }}
							</option>
						@endforeach
					</select>
				</td>
			</tr>
		</table>
		<br><hr><br>
		<button type="button" id="submit-btn">Update</button>
		<button type="button" id="cancel-btn">Cancel</button>	
	{{ Form::close() }}
@else	
	One or more of the variables below have not been defined in the HomeCmsController:
	<br>- $headlineEntries<br>- $cmsHeadlineCategories<br>- $cmsHeadlineRensaiPosts
	<br>- $cmsHeadlineFeaturesPosts<br>- $cmsHeadlineNewsPosts<br>- $cmsHeadlineGadgetsPosts  
@endif