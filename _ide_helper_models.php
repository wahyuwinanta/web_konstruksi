<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property int $product_id
 * @property string $name
 * @property string $phone_number
 * @property string $brief
 * @property int $budget
 * @property string $email
 * @property \Illuminate\Support\Carbon $meeting_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereBrief($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereBudget($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereMeetingAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment withoutTrashed()
 */
	class Appointment extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $thumbnail
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompanyKeypoint> $keypoints
 * @property-read int|null $keypoints_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyAbout newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyAbout newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyAbout onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyAbout query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyAbout whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyAbout whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyAbout whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyAbout whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyAbout whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyAbout whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyAbout whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyAbout withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyAbout withoutTrashed()
 */
	class CompanyAbout extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $company_about_id
 * @property string $keypoint
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyKeypoint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyKeypoint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyKeypoint onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyKeypoint query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyKeypoint whereCompanyAboutId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyKeypoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyKeypoint whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyKeypoint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyKeypoint whereKeypoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyKeypoint whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyKeypoint withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyKeypoint withoutTrashed()
 */
	class CompanyKeypoint extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $goal
 * @property string $icon
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyStatistic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyStatistic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyStatistic onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyStatistic query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyStatistic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyStatistic whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyStatistic whereGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyStatistic whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyStatistic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyStatistic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyStatistic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyStatistic withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompanyStatistic withoutTrashed()
 */
	class CompanyStatistic extends \Eloquent {}
}

namespace App\Models{
/**
 * @property-read \App\Models\User|null $owner
 * @property-read \App\Models\Project|null $project
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Evaluation query()
 */
	class Evaluation extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $achievement
 * @property string $heading
 * @property string $subheading
 * @property string $path_video
 * @property string $banner
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroSection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroSection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroSection onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroSection query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroSection whereAchievement($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroSection whereBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroSection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroSection whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroSection whereHeading($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroSection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroSection wherePathVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroSection whereSubheading($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroSection whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroSection withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HeroSection withoutTrashed()
 */
	class HeroSection extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $message
 * @property int|null $project_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereUpdatedAt($value)
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $subtitle
 * @property string $thumbnail
 * @property string $icon
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurPrinciple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurPrinciple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurPrinciple onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurPrinciple query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurPrinciple whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurPrinciple whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurPrinciple whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurPrinciple whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurPrinciple whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurPrinciple whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurPrinciple whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurPrinciple whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurPrinciple withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurPrinciple withoutTrashed()
 */
	class OurPrinciple extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $occupation
 * @property string $avatar
 * @property string $location
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurTeam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurTeam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurTeam onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurTeam query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurTeam whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurTeam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurTeam whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurTeam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurTeam whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurTeam whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurTeam whereOccupation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurTeam whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurTeam withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OurTeam withoutTrashed()
 */
	class OurTeam extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $tagline
 * @property string $thumbnail
 * @property string $about
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Appointment> $appointments
 * @property-read int|null $appointments_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereTagline($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product withoutTrashed()
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $project_name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property string $status
 * @property int $created_by
 * @property int|null $approved_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectAssignment> $assignments
 * @property-read int|null $assignments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectProgress> $progress
 * @property-read int|null $progress_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereProjectName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Project whereUpdatedAt($value)
 */
	class Project extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $project_id
 * @property int $user_id
 * @property string $assigned_date
 * @property string|null $task_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectAssignment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectAssignment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectAssignment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectAssignment whereAssignedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectAssignment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectAssignment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectAssignment whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectAssignment whereTaskDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectAssignment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectAssignment whereUserId($value)
 */
	class ProjectAssignment extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $occupation
 * @property string $avatar
 * @property string $logo
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectClient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectClient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectClient onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectClient query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectClient whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectClient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectClient whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectClient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectClient whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectClient whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectClient whereOccupation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectClient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectClient withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectClient withoutTrashed()
 */
	class ProjectClient extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $project_id
 * @property int $user_id
 * @property string $progress_description
 * @property int $progress_percentage
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectProgress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectProgress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectProgress query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectProgress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectProgress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectProgress whereProgressDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectProgress whereProgressPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectProgress whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectProgress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ProjectProgress whereUserId($value)
 */
	class ProjectProgress extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $thumbnail
 * @property string $message
 * @property int $project_client_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ProjectClient $client
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereProjectClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Testimonial withoutTrashed()
 */
	class Testimonial extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property bool $is_active
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Notification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property-read \App\Models\User|null $pegawai
 * @property-read \App\Models\Project|null $project
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkProgress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkProgress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkProgress query()
 */
	class WorkProgress extends \Eloquent {}
}

