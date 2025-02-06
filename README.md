# Tools4ever

## Leerdoelen

- [ ] Ik kan entiteiten uit een database tonen op het scherm
- [ ] Ik kan een enkele entiteit uit een database tonen op het scherm
- [ ] Ik kan een nieuwe entiteit toevoegen aan de database
- [ ] Ik kan een entiteit verwijderen uit de database
- [ ] Ik kan een entiteit wijzigen in de database
- [ ] 


## Starterscode



## Entiteit verwijderen

Door gebruik te maken van de `DELETE` query kun je een entiteit uit de database verwijderen. Als je een parameter meegeeft aan de URL, dan wordt deze gebruikt om de specifieke entiteit te verwijderen.

Voorbeelden:

`users_delete.php?id=1`

`tools_delete.php?id=1`

`brands_delete.php?id=1`

Op een index pagina zou je deze URL's kunnen gebruiken om een entiteit te verwijderen.

```php
// users_index.php
echo "<a href='users_delete.php?id=" . $user['id'] . "'>Verwijder</a>";
```

of

```php
// tools_index.php
echo "<a href='tools_delete.php?id=" . $tool['id'] . "'>Verwijder</a>";
```

of

```php
// brands_index.php
echo "<a href='brands_delete.php?id=" . $brand['id'] . "'>Verwijder</a>";
```


```sql
-- Verwijder een entiteit uit de database
$id = $_GET['id'];
DELETE FROM users WHERE id = $id;

-- Verwijder een entiteit uit de database
$id = $_GET['id'];
DELETE FROM tools WHERE id = $id;

-- Verwijder een entiteit uit de database
$id = $_GET['id'];
DELETE FROM brands WHERE id = $id;
```

Om de query daadwerkelijk uit te voeren, moet je deze ook nog uitvoeren.

```php
// users_delete.php
require_once 'database.php';

$id = $_GET['id'];
$query = "DELETE FROM users WHERE id = $id";
mysqli_query($conn, $query);
header('Location: users_index.php');
```

### Opdracht 1

Maak de `tools_delete.php` file aan.

### Opdracht 2

Maak de `brands_delete.php` file aan.

### Opdracht 3

Maak de `users_delete.php` file aan.



















