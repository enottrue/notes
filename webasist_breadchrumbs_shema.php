{strip}
{$_breadcrumbs = []}
{$_is_main_page = $wa->globals('isHomePage')}
{$_is_personal_area = $wa->globals('isMyAccount')}

{if !($_is_main_page || $_is_personal_area || empty($breadcrumbs))}
    {$_breadcrumbs[] = [
        "url" => $wa_app_url,
        "name" =>  "[`Home`]"]
    }
    {$_breadcrumbs = array_merge($_breadcrumbs,$breadcrumbs)}
{/if}
{$index=0}
<div class="breadcrumbs">
 <ul class="breadcrumbs__list" itemscope itemtype="http://schema.org/BreadcrumbList">
     
        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                <a class="breadcrumbs__link" itemprop="item" href="{$wa_url}"><div itemprop="name">Главная</div>
                </a><meta itemprop="position" content="1" />
        </li>
        {if !empty($breadcrumbs)}
                {foreach $breadcrumbs as $counter=>$breadcrumb}
                        {if !empty($breadcrumb)}
                                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"> 
                                    <span class="breadcrumbs__sep">-</span> <span class="breadcrumbs__link"><a href="{$breadcrumb.url}" itemprop="item">{$breadcrumb.name|escape}</a>
                                    <meta itemprop="name" content="{$breadcrumb.name|escape}" />
                                    </span>
                                    <meta itemprop="position" content="{$breadcrumb@iteration + 1}" />
                                    {assign var=bcounter value=$breadcrumb@iteration + 1}
                                </li>
                        {/if}
                {/foreach}
        {/if}
        <li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                <span class="breadcrumbs__sep">-</span>
                {if ($action == 'category' && isset($category))}
                        <span class="breadcrumbs__link" itemprop="name">{$category.name}</span>
                {elseif ($action == 'product' && isset($product))}
                        <span class="breadcrumbs__link" itemprop="name">{$product.name}</span>
                {elseif ($action == 'brand' && isset($brand))} {*для плагина бренды с картинками*}
                        <span class="breadcrumbs__link"><a class="breadcrumbs__link" itemprop="item" href="/{$action}/">Бренды</a></span><span class="breadcrumbs__sep">-</span><span class="breadcrumbs__link" itemprop="name">{$wa->title()}</span>
                {elseif ($action == 'page' && isset($page))}
                        <span class="breadcrumbs__link" itemprop="name">{$page.name}</span>
                {elseif $action == 'checkout'}
                        <span class="breadcrumbs__link" itemprop="name">[`Checkout`]</span>
                {else}
                        <meta itemprop="item" content="{$wa->currentUrl()}" />
                        <span class="breadcrumbs__link" itemprop="name">{$wa->title()}</span>
                {/if}
                <meta itemprop="position" content="{if !empty($bcounter)}{$bcounter + 1}{else}2{/if}" />  
        </li>
</ul>
</div>
