<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Absence
 *
 * @property int $id
 * @property string $date
 * @property int $classe_id
 * @property int $formateur_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Absence_stagiaire> $absencesStagiaires
 * @property-read int|null $absences_stagiaires_count
 * @property-read \App\Models\Classe $classe
 * @property-read \App\Models\Formateur $formateur
 * @method static \Database\Factories\AbsenceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Absence newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Absence newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Absence query()
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereClasseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereFormateurId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence whereUpdatedAt($value)
 */
	class Absence extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Absence_stagiaire
 *
 * @property int $id
 * @property int $absence_id
 * @property int $stagiaire_id
 * @property string $preuve
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Absence $absence
 * @property-read \App\Models\Stagiaire $stagiaire
 * @method static \Database\Factories\Absence_stagiaireFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Absence_stagiaire newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Absence_stagiaire newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Absence_stagiaire query()
 * @method static \Illuminate\Database\Eloquent\Builder|Absence_stagiaire whereAbsenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence_stagiaire whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence_stagiaire whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence_stagiaire wherePreuve($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence_stagiaire whereStagiaireId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Absence_stagiaire whereUpdatedAt($value)
 */
	class Absence_stagiaire extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Admin
 *
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property string $email
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Classe> $classes
 * @property-read int|null $classes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Formateur> $formateurs
 * @property-read int|null $formateurs_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\AdminFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUpdatedAt($value)
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Classe
 *
 * @property int $id
 * @property string $branche
 * @property int $num_group
 * @property string $annee_scolaire
 * @property int $admin_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Absence> $absences
 * @property-read int|null $absences_count
 * @property-read \App\Models\Admin $admin
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Stagiaire> $stagiaires
 * @property-read int|null $stagiaires_count
 * @method static \Database\Factories\ClasseFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Classe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classe query()
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereAnneeScolaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereBranche($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereNumGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereUpdatedAt($value)
 */
	class Classe extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Formateur
 *
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property string $email
 * @property string $password
 * @property int $admin_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Absence> $absences
 * @property-read int|null $absences_count
 * @property-read \App\Models\Admin $admin
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\FormateurFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Formateur newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Formateur newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Formateur query()
 * @method static \Illuminate\Database\Eloquent\Builder|Formateur whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formateur whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formateur whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formateur whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formateur whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formateur wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formateur wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formateur whereUpdatedAt($value)
 */
	class Formateur extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Stagiaire
 *
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property int $classe_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Classe $Classe
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Absence_stagiaire> $absencesStagiaires
 * @property-read int|null $absences_stagiaires_count
 * @method static \Database\Factories\StagiaireFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Stagiaire newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stagiaire newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stagiaire query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stagiaire whereClasseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stagiaire whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stagiaire whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stagiaire whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stagiaire wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stagiaire whereUpdatedAt($value)
 */
	class Stagiaire extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

