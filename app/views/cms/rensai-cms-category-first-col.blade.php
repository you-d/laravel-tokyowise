 <!-- CMS - Rensai Category : Create a New Post & Delete an existing post -->
<div id="rensai-category-cms-post-list-overlay" class="cms-overlay">
	<div class="cms-buttons-container">
		<div id="rensai-category-cms-edit-category" class="cms-button cms-button-white cms-button-width150">Edit Category</div>
		<div id="rensai-category-cms-create-post" class="cms-button cms-button-grey cms-button-width150">Create a Post</div>
		<div id="rensai-category-cms-delete-post" class="cms-button cms-button-red cms-button-width150">Delete a Post</div>
	</div>
	<div id="rensai-category-create-post-dialog" class="cms-dialog" >
		<h1>[ Rensai - Category ] Create a New Post</h1>
		<hr><br>
		@if(isset($rensaiCategory) && isset($rensaiPosts))
			{{ Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url("/cms/rensai/" . $rensaiCategory->id) ]) }}
			<table class="cms-content-frame">
				<tr>
					<td class="left-col">Title : </td>
					<td class="right-col">
						{{ Form::text('post-title', '', array('id'=>'post-title','class'=>'right-col-input','style'=>'width:90%;')) }}
					</td>
				</tr>
				<tr>
					<td class="left-col">Main Article Image : </td>
					<td class="right-col">
						{{ Form::file('main-article-img', array('id'=>'main-article-img','class'=>'right-col-input')) }}
					</td>
				</tr>
				<tr>
					<td class="left-col">Article Body : </td>
					<td class="right-col">
						{{ Form::file('article-body', array('id'=>'article-body','class'=>'right-col-input')) }}
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div id="error-list"></div>
					</td>
				</tr>
			</table>
			<hr><br>
			<button type="button" id="submit-btn">Create</button>
			<button type="button" id="cancel-btn">Cancel</button>
			{{ Form::close() }}
		@else
			The $rensaiCategory & $rensaiPost have not been defined in the RensaiCmsController.
		@endif
	</div>
	<div id="rensai-category-edit-category-dialog" class="cms-dialog">
		<h1>[ Rensai - Category ] Edit This Category Record</h1>
		<hr><br>
		@if(isset($rensaiCategory))
			{{ Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url("/cms/rensai/" . $rensaiCategory->id) ]) }}
			<table class="cms-content-frame">
				<tr class="height40">
					<td class="left-col">Title : </td>
					<td class="right-col">
						{{ Form::text('category-title', $rensaiCategory->category_name, array('id'=>'category-title','class'=>'right-col-input')) }}
					</td>
				</tr>
				<tr class="height40">
					<td class="left-col">Description : </td>
					<td class="right-col">
						{{ Form::textarea('category-description', $rensaiCategory->group_desc, array('id'=>'category-description','class'=>'right-col-input right-col-area')) }}
					</td>
				</tr>
				<tr class="height40">
					<td class="left-col">Replace Header Image : </td>
					<td class="right-col">
						{{ Form::file('category-header-img', array('id'=>'category-header-img','class'=>'right-col-input')) }}
					</td>
				</tr>
				<tr class="height40">
					<td class="left-col">Replace Article Header Image : </td>
					<td class="right-col">
						{{ Form::file('article-header-img', array('id'=>'article-header-img','class'=>'right-col-input')) }}
					</td>
				</tr>
				<tr class="height40">
					<td class="left-col">Replace Side Icon Image : </td>
					<td class="right-col">
						{{ Form::file('side-icon-img', array('id'=>'side-icon-img','class'=>'right-col-input')) }}
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div style="line-height:200%;font-size:10px;">
							Last Update :&nbsp;
							<span style="color:#F00000;">{{ date("d/m/Y h:i:s a", strtotime($rensaiCategory->updated_at)) }}</span>
							&nbsp;[ GMT + 10 ]
						</div>
						<div id="error-list"></div>
					</td>
				</tr>
			</table>
			<hr><br>
			<button type="button" id="submit-btn">Update</button>
			<button type="button" id="cancel-btn">Cancel</button>
			{{ Form::close() }}
		@else

		@endif
	</div>
	<div id="rensai-category-delete-post-dialog" class="cms-dialog" >
		<h1>[ Rensai - Category ] Delete a Post</h1>
		<hr><br>
		@if(isset($rensaiCategory) && isset($rensaiPosts))
			{{ Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url("/cms/rensai/" . $rensaiCategory->id) ]) }}
			<input type="hidden" id="category-id" value="{{ $rensaiCategory->id }}">
			<table class="cms-content-frame" style="width:98%;">
				<caption style="font-size:12px; font-weight:normal; color:#F00000;">
					<div id="error-list"></div>
				</caption>
				<tr>
					<td class="left-col">Delete this post : </td>
					<td class="right-col">
						<select id="selected-post" class="right-col-input">
							@foreach ($rensaiPosts as $rensaiPost)
								<option value="{{ $rensaiPost->id }}">
									[{{ $rensaiPost->post_id }}]
									&nbsp;
									@if (strlen($rensaiPost->post_title) > 80)
										{{ mb_substr($rensaiPost->post_title, 0, 35) . ' ...' }}
									@else
										{{ $rensaiPost->post_title }}
									@endif
								</option>
							@endforeach
						</select>
					</td>
				</tr>
			</table>
			<hr><br>
			<button type="button" id="submit-btn">Delete</button>
			<button type="button" id="cancel-btn">Cancel</button>
			{{ Form::close() }}
		@else
			The $rensaiCategory & $rensaiPost have not been defined in the RensaiCmsController.
		@endif
	</div>
</div>
<section id="rensai-category-first-col" class="first-col-wide">
	<div class="cms_panel_fixer">
		<!-- Social Media Link -->
		@include('module-social-media-sp')
		<!-- Header Image -->
		<div id="rensai-category-group-img">
			{{ HTML::image('images/rensai/categories/' . $rensaiCategory->group_img, $rensaiCategory->group_img) }}
		</div>
		<!-- Header Desc -->
		<div id="rensai-category-desc">
			{{ $rensaiCategory->group_desc }}
		</div>
		<!-- Entries -->
		<div id="rensai-category-entries">
		@foreach ($rensaiPosts as $rensaiPost)
		<div class="rensai-entry">
			<dl>
				<dt>
					<a href="{{ url() }}/cms/rensai/{{ $rensaiCategory->id }}/{{ $rensaiPost->post_id }}">
						{{ HTML::image('images/rensai/posts/' . $rensaiPost->thumbnail_img, $rensaiPost->thumbnail_img) }}
					</a>
				</dt>
				<dd>
					<a href="{{ url() }}/cms/rensai/{{ $rensaiCategory->id }}/{{ $rensaiPost->post_id }}">
						@if (strlen($rensaiPost->post_title) > 100)
							{{ mb_substr($rensaiPost->post_title, 0, 70) . ' ...' }}
						@else
							{{ $rensaiPost->post_title }}
						@endif
					</a>
				</dd>
			</dl>
			<p class="posting-date">{{ date("d/m/Y", strtotime($rensaiPost->posting_date)) }}</p>
		</div>
		@endforeach
		</div>
	</div>
</section>
