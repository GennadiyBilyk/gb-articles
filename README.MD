#installation


*Пакет требует установленных пакетов*
     "laravelrus/sleepingowl": "4.*@dev",
     
     "baum/baum": "~1.1"


#Установка пакета
	 Добавляем в composer.json require секция "gennadiy-bilyk/articles":"*@dev"
	 composer update
     
     Добавляем сервис провайдеры в config/app
	      GennadiyBilyk\Articles\ArticlesProvider::class,
		  
	 Выполняем 
	 
	  php artisan vendor:publish --provider="GennadiyBilyk\Articles\ArticlesProvider" --force
	 php artisan migrate
	 
	  
#Настройка пакета	  
	  Добавляем пункты меню в app/Admin/navigation.php    
	         AdminSection::addMenuPage(\App\Models\Article\Articlescategory::class),
             AdminSection::addMenuPage(\App\Models\Article\Article::class),
             AdminSection::addMenuPage(\App\Models\Article\ArticleAuthor::class),
      
	     
	     
	  Добавляем модель в app\Providers\AdminSectionsServiceProvider.php свойство $sections         
	        
              \App\Models\Article\Article::class=>'App\Http\Sections\Articles',
              \App\Models\Article\ArticleAuthor::class=>'App\Http\Sections\ArticleAuthors',
              \App\Models\Article\Articlescategory::class=>'App\Http\Sections\Articlescategories',
	  

	  
	  Добавляем js файл из репозитория https://github.com/GennadiyBilyk/jsTranslite в public/js/translite.js
	  
	  
	  все готово!