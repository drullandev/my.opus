Hello!
I was trying to get data from the database from a controller and I found a lot of problemas.
At least, i won't be able to connect/retrieve/persist any data from MyController.

This is a test consist in:
- A clear project with a command MyTest to get a new instance to controller MyTableController where i try to persist a data as documentation.
- The error is: 'Call to a member function has() on null'
- I was searching on web for three days without solution, and i tried a lot of:
I tried with https://stackoverflow.com/questions/49600092/symfony-4-request-object-change?noredirect=1&lq=1 struct, but i get the next error::

In DefinitionErrorExceptionPass.php line 54:

  Cannot autowire service "App\Controller\MyTableController": argument "$entityManager" of method "__construct()" reference
  s class "Doctrine\ORM\EntityManager" but no such service exists. Try changing the type-hint to one of its parents: interf
  ace "Doctrine\ORM\EntityManagerInterface", or interface "Doctrine\Common\Persistence\ObjectManager".