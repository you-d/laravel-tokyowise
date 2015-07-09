<section id="rensai-first-col" class="first-col-wide">
	<!-- Social Media Link -->
	@include('module-social-media-sp')
	<!-- Page Header Image -->
	<div class="page-header-img">
		{{ HTML::image('images/rensai/general/rensai-first-col-header-img.png', 'Rensai Page Header Image') }}
	</div>
	<div class="page-header-img-sp">
		{{ HTML::image('images/rensai/general/rensai-first-col-header-img-sp.png', 'Rensai Page Header Image Sp') }}
	</div>
	<!-- New Articles Section -->
	<div id="rensai-new-articles-list">
		<h2>新着記事</h2>
		@foreach ($rensaiPosts as $rensaiPost)
		<div class="rensai-article-entry rensai-article-entry-first-sp">
			<a href="{{ url() }}/cms/rensai/{{ $rensaiPost->category_id }}/{{ $rensaiPost->post_id }}">
				<span class="posting-date">{{ date("d/m/Y", strtotime($rensaiPost->posting_date)) }}</span>
				<span class="rensai-article-title">
					{{ $rensaiPost->post_title }}
				</span>
			</a>
		</div>
		@endforeach
	</div>
	<!-- CMS - New Articles List Section -->
	<div id="rensai-cms-new-article-section-overlay" class="cms-overlay">
		<div class="cms-transparent-overlay"></div>
		<div class="cms-buttons-container">
			<div id="edit-rensai-new-article-section" class="cms-button cms-button-red">Edit</div>
		</div>
		<div id="rensai-new-article-section-dialog" class="cms-dialog" >
			<h1>[ Rensai ] Articles List Column</h1>
			<hr><br>
			@if (isset($rensaiPosts))
				{{Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url('/cms/rensai'),
							   'class' => '', 'accept-charset' => 'UTF-8']) }}
					<?php $tot = count($rensaiPosts); ?>
					Number of entries :&nbsp;
					<select id="entries-num">
						<?php for($i=5; $i<=15; $i++) { ?>
							<option value="{{ $i }}" <?php if($tot == $i) { ?>selected<?php } ?> >{{ $i }}</option>
						<?php } ?>
					</select>
					<br><br><hr><br>
					<button type="button" id="submit-btn">Update</button>
					<button type="button" id="cancel-btn">Cancel</button>
				{{ Form::close() }}
			@else
				The $rensaiPosts has not been defined in the RensaiCmsController.
			@endif
		</div>
	</div>
	<!-- CMS - Article Categories Section -->
	<div id="rensai-cms-article-cat-list-overlay" class="cms-overlay">
		<div class="cms-buttons-container">
			<div id="add-rensai-article-cat" class="cms-button cms-button-grey">Add</div>
			<div id="remove-rensai-article-cat" class="cms-button cms-button-red">Remove</div>
		</div>
		<div id="rensai-create-article-category-dialog" class="cms-dialog" >
			<h1>[ Rensai ] Article Categories Column</h1>
			<hr>
			<table id="table1" class="cms-content-frame">
				<caption><p>Create a New Rensai Category</p></caption>
				<tr>
					<td class="left-col">Title : </td>
					<td class="right-col">
						{{ Form::text('category-title', '', array('id'=>'category-title','class'=>'right-col-input')) }}
					</td>
				</tr>
				<tr>
					<td class="left-col">Description : </td>
					<td class="right-col">
						{{ Form::text('category-description', '', array('id'=>'category-description','class'=>'right-col-input')) }}
					</td>
				</tr>
				<tr>
					<td class="left-col">Header Image : </td>
					<td class="right-col">
						{{ Form::file('category-header-img', array('id'=>'category-header-img','class'=>'right-col-input')) }}
					</td>
				</tr>
				<tr>
					<td class="left-col">Article Header Image : </td>
					<td class="right-col">
						{{ Form::file('article-header-img', array('id'=>'article-header-img','class'=>'right-col-input')) }}
					</td>
				</tr>
				<tr>
					<td class="left-col">Side Icon Image : </td>
					<td class="right-col">
						{{ Form::file('side-icon-img', array('id'=>'side-icon-img','class'=>'right-col-input')) }}
					</td>
				</tr>
			</table>
			<br>
			<table id="table2" class="cms-content-frame">
				<caption><p>Create the First Post</p></caption>
				<tr>
					<td class="left-col">Title : </td>
					<td class="right-col">
						{{ Form::text('post-title', '', array('id'=>'post-title','class'=>'right-col-input')) }}
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
						<br><div id="error-list"></div><br>
					</td>
				</tr>
			</table>
			<hr><br>
			<button type="button" id="submit-btn">Create</button>
			<button type="button" id="cancel-btn">Cancel</button>
		</div>
		<div id="rensai-remove-article-category-dialog" class="cms-dialog" >
			<h1>[ Rensai ] Article Categories Column</h1>
			<hr>
			<br>
			@if(isset($rensaiCategories))
				{{ Form::open(['id' => 'cms-form', 'method' => 'POST', 'url' => url("/cms/rensai") ]) }}
				<table class="cms-content-frame">
					<caption>
						<p>Warning! Deleting a category will delete all posts under this category.</p>
					</caption>
					<tr>
						<td class="left-col">Delete this category : </td>
						<td class="right-col">
							<select id="selected-category" class="right-col-input">
								@foreach ($rensaiCategories as $rensaiCategory)
									<option value="{{ $rensaiCategory->id }}">
										{{ $rensaiCategory->category_name }}
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
				The $rensaiCategories has not been defined in the RensaiCmsController.
			@endif
		</div>
	</div>
	<!-- Article Categories Section -->
	<div id="rensai-article-cat-list">
		<h2>テーマ別</h2>
		<div id="rensai-article-cat-list-container">
			<?php $counter = 0; ?>
			@foreach ($rensaiCategories as $rensaiCategory)
			<div class="rensai-article-cat-entry">
				<a href="{{ url() }}/cms/rensai/{{ $rensaiCategory->id }}">
					<div class="rensai-article-cat-entry-info">
						<div class="rensai-article-cat-entry-title">{{ $rensaiCategory->category_name }}</div>
						<div class="rensai-article-cat-entry-desc">
							@if (strlen($rensaiCategory->group_desc) > 100)
								{{ mb_substr($rensaiCategory->group_desc, 0, 35) . ' ...' }}
							@else
								{{ $rensaiCategory->group_desc }}
							@endif
						</div>
						<div class="rensai-article-cat-entry-more-sp">一覧を見る</div>
					</div>
					<div class="rensai-article-cat-entry-img">
						{{ HTML::image('images/rensai/posts/' . $rensaiLatestThumbImgs [$counter] [0], 'comapps_02_LAOS') }}
					</div>
					<div class="rensai-article-cat-entry-more">一覧を見る</div>
				</a>
			</div>
			<?php $counter++; ?>
			@endforeach
		</div>
	</div>
</section>
