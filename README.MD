#installation


*Пакет требует установленных пакетов*
     "laravelrus/sleepingowl": "4.*@dev",
     "baum/baum": "~1.1"


#Установка пакета
	 Добавляем в composer.json require секция "gennadiy-bilyk/articles":"*@dev"
     
     Добавляем сервис провайдеры в config/app
	      GennadiyBilyk\Articles\ArticlesProvider::class,
		  
	 Выполняем 
	 
	 php artisan vendor:publish
	 php artisan migrate
	 
	  
#Настройка пакета	  
	  Добавляем пункты меню в app/Admin/navigation.php    
	         AdminSection::addMenuPage(\App\Models\Article\Articlescategory::class),
             AdminSection::addMenuPage(\App\Models\Article\Article::class),
             AdminSection::addMenuPage(\App\Models\Article\ArticleAuthor::class),
             [
                 'title' => 'Permissions',
                 'icon' => 'fa fa-exclamation',
                 'priority' =>'10000',
                 'pages' => [
         
                     (new Page(\App\Models\Permission\Role::class))
                         ->setPriority(100),
                     (new Page(\App\User::class))
                         ->setPriority(100)
                 ]
             ]
	     
	     
	  Добавляем модель в app\Providers\AdminSectionsServiceProvider.php свойство $sections         
	          \App\User::class => 'App\Http\Sections\Users',
              \App\Models\Article\Article::class=>'App\Http\Sections\Articles',
              \App\Models\Permission\Role::class=>'App\Http\Sections\Roles',
              \App\Models\Article\ArticleAuthor::class=>'App\Http\Sections\ArticleAuthors',
              \App\Models\Article\Articlescategory::class=>'App\Http\Sections\Articlescategories',
	  
	  Заюзаем trait App\Models\Permission\HasRoles в модели User
	  
	  все готово!