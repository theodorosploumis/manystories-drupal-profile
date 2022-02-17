## How to install this Drupal profile

Before starting check the [Drupal documentation guides](https://www.drupal.org/documentation/install) at Drupal.org.

You may need to have basic programming knowledge.

```

// Download drupal on the folder of your website (let's call this www)
cd www

// The best method is using Drush.
drush dl drupal-7.41

// If you don't have drush
wget https://ftp.drupal.org/files/projects/drupal-7.41.zip
unzip drupal-7.41.zip

// You will now have this structure
// 'www/drupal-7.41/'

// Remove the sites/all folder
cd drupal-7.41
rm -r sites/all

// Clone this repository while being at root/drupal-7.41
git clone git@github.com:manystories/drupal.git

// Move drupal/sites/all folder into sites/all
mv drupal/sites/all sites/

// Install Drupal normally. Select the minimal profile.
...

// On you new website enable the backup_migrate module
drush en -y backup_migrate

// Go to the backup and migrate settings (admin/config/system/backup_migrate/restore) and restore the demo database found below.

```

#### Demo database
- [Download](https://goo.gl/au0HK8) the database.

#### Drupal admin
- user: admin
- pass: admin

#### Content
By default only one Story is provided on the demo and all the other pages are empty pointing to the online documentation.

### Dashboard

After installing the demo database go to the site Dashboard (/admin/dashboard) and add/edit settings.
