<?php // phpcs:ignore WordPress.NamingConventions.ValidFunctionName
/**
 * Redux Framework User Meta API Class
 * Makes instantiating a Redux object an absolute piece of cake.
 *
 * @package     Redux_Framework
 * @author      Dovy Paukstys
 * @subpackage  Users
 */

defined( 'ABSPATH' ) || exit;

// Don't duplicate me!
if ( ! class_exists( 'Redux_Users' ) ) {

	/**
	 * Redux Users API Class
	 * Simple API for Redux Framework
	 *
	 * @since       1.0.0
	 */
	class Redux_Users {

		/**
		 * Profile array.
		 *
		 * @var array
		 */
		public static $profiles = [];

		/**
		 * Sections array.
		 *
		 * @var array
		 */
		public static $sections = [];

		/**
		 * Fields array.
		 *
		 * @var array
		 */
		public static $fields = [];

		/**
		 * Priority array.
		 *
		 * @var array
		 */
		public static $priority = [];

		/**
		 * Errors array.
		 *
		 * @var array
		 */
		public static $errors = [];

		/**
		 * Init array.
		 *
		 * @var array
		 */
		public static $init = [];

		/**
		 * Has run flag.
		 *
		 * @var bool
		 */
		public static $has_run = false;

		/**
		 * Args array.
		 *
		 * @var array
		 */
		public static $args = [];

		/**
		 * Load.
		 */
		public static function load() {
			add_action( 'init', [ 'Redux_Users', 'enqueue' ], 99 );
		}

		/**
		 * Enqueue support files and fields.
		 */
		public static function enqueue() {
			global $pagenow;

			// Check and run instances of Redux where the opt_name hasn't been run.
			$pagenows = [ 'user-new.php', 'profile.php', 'user-edit.php' ];

			if ( ! empty( self::$sections ) && in_array( $pagenow, $pagenows, true ) ) {
				$instances = ReduxFrameworkInstances::get_all_instances();

				foreach ( self::$fields as $opt_name => $fields ) {
					if ( ! isset( $instances[ $opt_name ] ) ) {
						Redux::set_args( $opt_name, [ 'menu_type' => 'hidden' ] );
						Redux::set_sections(
							$opt_name,
							[
								[
									'id'     => 'EXTENSION_USERS_FAKE_ID' . $opt_name,
									'fields' => $fields,
									'title'  => 'N/A',
								],
							]
						);

						Redux::init( $opt_name );
					} else {
						remove_action( 'admin_enqueue_scripts', [ ReduxFrameworkInstances::get_instance( $opt_name ), '_enqueue' ] );
					}

					self::check_opt_name( $opt_name );

					Redux::set_args( $opt_name, self::$args[ $opt_name ] );
				}

				$instances = Redux::all_instances();

				add_action( 'admin_enqueue_scripts', [ $instances[ $opt_name ], '_enqueue' ], 1 );
			}
		}

		/**
		 * Construct Args.
		 *
		 * @param string $opt_name Panel Opt Name.
		 *
		 * @return mixed
		 */
		public static function construct_args( $opt_name ) {
			$args             = self::$args[ $opt_name ];
			$args['opt_name'] = $opt_name;

			if ( ! isset( $args['menu_title'] ) ) {
				$args['menu_title'] = ucfirst( $opt_name ) . ' Options';
			}

			if ( ! isset( $args['page_title'] ) ) {
				$args['page_title'] = ucfirst( $opt_name ) . ' Options';
			}

			if ( ! isset( $args['page_slug'] ) ) {
				$args['page_slug'] = $opt_name . '_options';
			}

			return $args;
		}

		/**
		 * Construct Profiles.
		 *
		 * @param string $opt_name Panel opt_name.
		 *
		 * @return array
		 */
		public static function construct_profiles( $opt_name ) {
			$profiles = [];

			if ( ! isset( self::$profiles[ $opt_name ] ) ) {
				return $profiles;
			}

			foreach ( self::$profiles[ $opt_name ] as $profile_id => $profile ) {
				$permissions         = isset( $profile['permissions'] ) ? $profile['permissions'] : false;
				$roles               = isset( $profile['roles'] ) ? $profile['roles'] : false;
				$profile['sections'] = self::construct_sections( $opt_name, $profile['id'], $permissions, $roles );
				$profiles[]          = $profile;
			}

			ksort( $profiles );

			return $profiles;
		}

		/**
		 * Construct Sections.
		 *
		 * @param string $opt_name Panel opt_name.
		 * @param int    $profile_id Profile ID.
		 * @param bool   $permissions Permissions.
		 * @param bool   $roles ROles.
		 *
		 * @return array
		 */
		public static function construct_sections( $opt_name, $profile_id, $permissions = false, $roles = false ) {
			$sections = [];

			if ( ! isset( self::$sections[ $opt_name ] ) ) {
				return $sections;
			}

			foreach ( self::$sections[ $opt_name ] as $section_id => $section ) {
				if ( $section['profile_id'] === $profile_id ) {

					self::$sections[ $opt_name ][ $section_id ]['roles'] = $section;

					$p = $section['priority'];

					while ( isset( $sections[ $p ] ) ) {
						echo esc_html( $p ++ );
					}

					$section['fields'] = self::construct_fields( $opt_name, $section_id );
					$sections[ $p ]    = $section;
				}
			}
			ksort( $sections );

			return $sections;
		}

		/**
		 * Construct Fields.
		 *
		 * @param string $opt_name Panel opt_name.
		 * @param string $section_id Section ID.
		 * @param bool   $permissions Permissions.
		 * @param bool   $roles Roles.
		 *
		 * @return array
		 */
		public static function construct_fields( $opt_name = '', $section_id = '', $permissions = false, $roles = false ) {
			$fields = [];

			if ( ! isset( self::$fields[ $opt_name ] ) ) {
				return $fields;
			}

			foreach ( self::$fields[ $opt_name ] as $key => $field ) {
				// Nested permissions.
				$field['permissions'] = isset( $field['permissions'] ) ? $field['permissions'] : $permissions;

				self::$fields[ $opt_name ][ $key ]['permissions'] = $field['permissions'];

				// Nested roles permissions.
				$field['roles'] = isset( $field['roles'] ) ? $field['roles'] : $roles;

				self::$fields[ $opt_name ][ $key ]['roles'] = $field['roles'];

				if ( $field['section_id'] === $section_id ) {
					$p = $field['priority'];

					while ( isset( $fields[ $p ] ) ) {
						echo esc_html( $p ++ );
					}

					$fields[ $p ] = $field;
				}
			}
			ksort( $fields );

			return $fields;
		}

		/**
		 * Get Section.
		 *
		 * @param string $opt_name Panel opt_name.
		 * @param string $id ID.
		 *
		 * @return bool
		 */
		public static function get_section( $opt_name = '', $id = '' ) {
			self::check_opt_name( $opt_name );

			if ( ! empty( $opt_name ) && ! empty( $id ) ) {
				if ( ! isset( self::$sections[ $opt_name ][ $id ] ) ) {
					$id = strtolower( sanitize_html_class( $id ) );
				}

				return isset( self::$sections[ $opt_name ][ $id ] ) ? self::$sections[ $opt_name ][ $id ] : false;
			}

			return false;
		}

		/**
		 * Set args.
		 *
		 * @param string $opt_name Panel opt_name.
		 * @param array  $args Args array.
		 */
		public static function set_args( $opt_name = '', $args = [] ) {
			self::check_opt_name( $opt_name );

			if ( ! empty( $opt_name ) && is_array( $args ) && ! empty( $args ) ) {
				self::$args[ $opt_name ] = isset( self::$args[ $opt_name ] ) ? self::$args[ $opt_name ] : [];
				self::$args[ $opt_name ] = wp_parse_args( $args, self::$args[ $opt_name ] );
			}
		}

		/**
		 * Deprecated Sets option panel global arguments.
		 *
		 * @param     string $opt_name Panel opt_name.
		 * @param     array  $args Argument data.
		 *
		 * @deprecated No longer using camelCase naming convention.
		 */
		public static function setArgs( $opt_name = '', $args = [] ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName
			if ( '' !== $opt_name ) {
				Redux_Functions_Ex::record_caller( $opt_name );
			}

			self::set_args( $opt_name, $args );
		}

		/**
		 * Set Section.
		 *
		 * @param string $opt_name Panel opt_name.
		 * @param array  $section Section array.
		 */
		public static function set_section( $opt_name = '', $section = [] ) {
			self::check_opt_name( $opt_name );

			if ( ! empty( $opt_name ) && is_array( $section ) && ! empty( $section ) ) {
				if ( ! isset( $section['id'] ) ) {
					if ( isset( $section['title'] ) ) {
						$section['id'] = strtolower( sanitize_html_class( $section['title'] ) );
					} else {
						$section['id'] = 'section';
					}

					if ( isset( self::$sections[ $opt_name ][ $section['id'] ] ) ) {
						$orig = $section['id'];
						$i    = 0;
						while ( isset( self::$sections[ $opt_name ][ $section['id'] ] ) ) {
							$section['id'] = $orig . '_' . $i;
						}
					}
				}

				if ( ! isset( $section['priority'] ) ) {
					$section['priority'] = self::get_priority( $opt_name, 'sections' );
				}

				if ( isset( $section['fields'] ) ) {
					if ( ! empty( $section['fields'] ) && is_array( $section['fields'] ) ) {

						if ( isset( $section['permissions'] ) || isset( $section['roles'] ) ) {
							foreach ( $section['fields'] as $key => $field ) {
								if ( ! isset( $field['permissions'] ) && isset( $section['permissions'] ) ) {
									$section['fields'][ $key ]['permissions'] = $section['permissions'];
								}
								if ( ! isset( $field['roles'] ) && isset( $section['roles'] ) ) {
									$section['fields'][ $key ]['roles'] = $section['roles'];
								}
							}
						}

						self::process_fields_array( $opt_name, $section['id'], $section['fields'] );
					}
					unset( $section['fields'] );
				}

				self::$sections[ $opt_name ][ $section['id'] ] = $section;
			} else {
				self::$errors[ $opt_name ]['section']['empty'] = esc_html__( 'Unable to create a section due an empty section array or the section variable passed was not an array.', 'redux-pro' );

				return;
			}
		}

		/**
		 * Process Section Array.
		 *
		 * @param string $opt_name Panel opt_name.
		 * @param string $profile_id Profile ID.
		 * @param array  $sections Sections array.
		 */
		public static function process_sections_array( $opt_name = '', $profile_id = '', $sections = [] ) {
			if ( ! empty( $opt_name ) && ! empty( $profile_id ) && is_array( $sections ) && ! empty( $sections ) ) {
				foreach ( $sections as $section ) {
					if ( ! is_array( $section ) ) {
						continue;
					}

					$section['profile_id'] = $profile_id;

					if ( ! isset( $section['fields'] ) || ! is_array( $section['fields'] ) ) {
						$section['fields'] = [];
					}

					self::set_section( $opt_name, $section );
				}
			}
		}

		/**
		 * Process Fields Array.
		 *
		 * @param string $opt_name Panel opt_name.
		 * @param string $section_id Section ID.
		 * @param array  $fields Fields array.
		 */
		public static function process_fields_array( $opt_name = '', $section_id = '', $fields = [] ) {
			if ( ! empty( $opt_name ) && ! empty( $section_id ) && is_array( $fields ) && ! empty( $fields ) ) {
				foreach ( $fields as $field ) {
					if ( ! is_array( $field ) ) {
						continue;
					}

					$field['section_id'] = $section_id;

					self::set_field( $opt_name, $field );
				}
			}
		}

		/**
		 * Get field.
		 *
		 * @param string $opt_name Panel opt_name.
		 * @param string $id Field ID.
		 *
		 * @return bool
		 */
		public static function get_field( $opt_name = '', $id = '' ) {
			self::check_opt_name( $opt_name );

			if ( ! empty( $opt_name ) && ! empty( $id ) ) {
				return isset( self::$fields[ $opt_name ][ $id ] ) ? self::$fields[ $opt_name ][ $id ] : false;
			}

			return false;
		}

		/**
		 * Set field.
		 *
		 * @param string $opt_name Panel opt_name.
		 * @param array  $field Field array.
		 */
		public static function set_field( $opt_name = '', $field = [] ) {
			self::check_opt_name( $opt_name );

			if ( ! empty( $opt_name ) && is_array( $field ) && ! empty( $field ) ) {
				if ( ! isset( $field['priority'] ) ) {
					$field['priority'] = self::get_priority( $opt_name, 'fields' );
				}

				self::$fields[ $opt_name ][ $field['id'] ] = $field;
			}
		}

		/**
		 * Set Profile.
		 *
		 * @param string $opt_name Panel opt_name.
		 * @param array  $profile Profile array.
		 */
		public static function set_profile( $opt_name = '', $profile = [] ) {
			self::check_opt_name( $opt_name );

			if ( ! empty( $opt_name ) && is_array( $profile ) && ! empty( $profile ) ) {
				if ( ! isset( $profile['id'] ) ) {
					if ( isset( $profile['title'] ) ) {
						$profile['id'] = strtolower( sanitize_html_class( $profile['title'] ) );
					} else {
						$profile['id'] = 'profile';
					}

					if ( isset( self::$profiles[ $opt_name ][ $profile['id'] ] ) ) {
						$orig = $profile['id'];
						$i    = 0;
						while ( isset( self::$profiles[ $opt_name ][ $profile['id'] ] ) ) {
							$profile['id'] = $orig . '_' . $i;
						}
					}
				}

				if ( isset( $profile['sections'] ) ) {
					if ( ! empty( $profile['sections'] ) && is_array( $profile['sections'] ) ) {
						if ( isset( $profile['permissions'] ) || isset( $profile['roles'] ) ) {
							foreach ( $profile['sections'] as $key => $section ) {
								if ( ! isset( $section['permissions'] ) && isset( $profile['permissions'] ) ) {
									$profile['sections'][ $key ]['permissions'] = $profile['permissions'];
								}
								if ( ! isset( $section['roles'] ) && isset( $profile['roles'] ) ) {
									$profile['sections'][ $key ]['roles'] = $profile['roles'];
								}
							}
						}

						self::process_sections_array( $opt_name, $profile['id'], $profile['sections'] );
					}

					unset( $profile['sections'] );
				}

				self::$profiles[ $opt_name ][ $profile['id'] ] = $profile;
			} else {
				self::$errors[ $opt_name ]['profile']['empty'] = esc_html__( 'Unable to create a profile due an empty profile array or the profile variable passed was not an array.', 'redux-pro' );

				return;
			}
		}

		/**
		 * Deprecated Set profile method.
		 *
		 * @param string $opt_name Panel opt_name.
		 * @param array  $profile Profile array.
		 *
		 * @deprecated No longer using camelCase naming convention.
		 */
		public static function setProfile( $opt_name = '', $profile = [] ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName
			if ( '' !== $opt_name ) {
				Redux_Functions_Ex::record_caller( $opt_name );
			}

			self::set_args( $opt_name, $profile );
		}

		/**
		 * Set Profiles.
		 *
		 * @param string $opt_name Panel opt_name.
		 * @param array  $profiles Profiles array.
		 */
		public static function set_profiles( $opt_name = '', $profiles = [] ) {
			if ( ! empty( $profiles ) && is_array( $profiles ) ) {
				foreach ( $profiles as $profile ) {
					self::set_profile( $opt_name, $profile );
				}
			}
		}

		/**
		 * Get profiles.
		 *
		 * @param string $opt_name Panel opt_name.
		 *
		 * @return mixed
		 */
		public static function get_profiles( $opt_name = '' ) {
			self::check_opt_name( $opt_name );

			if ( ! empty( $opt_name ) && ! empty( self::$profiles[ $opt_name ] ) ) {
				return self::$profiles[ $opt_name ];
			}
		}

		/**
		 * Deprecated Get profile method.
		 *
		 * @param string $opt_name Panel opt_name.
		 *
		 * @return mixed
		 * @deprecated No longer using camelCase naming convention.
		 */
		public static function getProfile( $opt_name = '' ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName
			if ( '' !== $opt_name ) {
				Redux_Functions_Ex::record_caller( $opt_name );
			}

			return self::get_profiles( $opt_name );
		}

		/**
		 * Get Box.
		 *
		 * @param string $opt_name Panel opt_name.
		 * @param string $key Key.
		 *
		 * @return mixed
		 */
		public static function get_box( $opt_name = '', $key = '' ) {
			self::check_opt_name( $opt_name );

			if ( ! empty( $opt_name ) && ! empty( $key ) && ! empty( self::$profiles[ $opt_name ] ) && isset( self::$profiles[ $opt_name ][ $key ] ) ) {
				return self::$profiles[ $opt_name ][ $key ];
			}
		}

		/**
		 * Deprecated Get box method.
		 *
		 * @param string $opt_name Panel opt_name.
		 * @param string $key Key.
		 *
		 * @return mixed
		 * @deprecated No longer using camelCase naming convention.
		 */
		public static function getBox( $opt_name = '', $key = '' ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName
			if ( '' !== $opt_name ) {
				Redux_Functions_Ex::record_caller( $opt_name );
			}

			return self::get_box( $opt_name );
		}

		/**
		 * Get Priority.
		 *
		 * @param string $opt_name Panel opt_name.
		 * @param mixed  $type Type.
		 *
		 * @return mixed
		 */
		public static function get_priority( $opt_name, $type ) {
			$priority                              = self::$priority[ $opt_name ][ $type ];
			self::$priority[ $opt_name ][ $type ] += 1;

			return $priority;
		}

		/**
		 * Deprecated Get box method.
		 *
		 * @param string $opt_name Panel opt_name.
		 * @param string $key Key.
		 *
		 * @return mixed
		 * @deprecated No longer using camelCase naming convention.
		 */
		public static function getPriority(  $opt_name, $type ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName
			if ( '' !== $opt_name ) {
				Redux_Functions_Ex::record_caller( $opt_name );
			}

			self::get_priority( $opt_name, $type );
		}

		/**
		 * Check opt name.
		 *
		 * @param string $opt_name Panel opt_name.
		 */
		public static function check_opt_name( $opt_name = '' ) {
			if ( empty( $opt_name ) || is_array( $opt_name ) ) {
				return;
			}

			if ( ! isset( self::$profiles[ $opt_name ] ) ) {
				self::$profiles[ $opt_name ] = [];
			}

			if ( ! isset( self::$priority[ $opt_name ] ) ) {
				self::$priority[ $opt_name ]['args'] = 1;
			}

			if ( ! isset( self::$sections[ $opt_name ] ) ) {
				self::$sections[ $opt_name ]             = [];
				self::$priority[ $opt_name ]['sections'] = 1;
			}

			if ( ! isset( self::$fields[ $opt_name ] ) ) {
				self::$fields[ $opt_name ]             = [];
				self::$priority[ $opt_name ]['fields'] = 1;
			}

			if ( ! isset( self::$errors[ $opt_name ] ) ) {
				self::$errors[ $opt_name ] = [];
			}

			if ( ! isset( self::$init[ $opt_name ] ) ) {
				self::$init[ $opt_name ] = false;
			}

			if ( ! isset( self::$args[ $opt_name ] ) ) {
				self::$args[ $opt_name ] = false;
			}
		}

		/**
		 * Get field defaults.
		 *
		 * @param string $opt_name Panel opt_name.
		 *
		 * @return array|void
		 */
		public static function get_field_defaults( $opt_name ) {
			if ( empty( $opt_name ) || is_array( $opt_name ) ) {
				return;
			}

			if ( ! isset( self::$fields[ $opt_name ] ) ) {
				return [];
			}

			$defaults = [];
			foreach ( self::$fields[ $opt_name ] as $key => $field ) {
				$defaults[ $key ] = isset( $field['default'] ) ? $field['default'] : '';
			}

			return $defaults;
		}

		/**
		 * Get user rold.
		 *
		 * @param int $user_id User ID.
		 *
		 * @return mixed
		 */
		public static function get_user_role( $user_id = 0 ) {
			$user = ( $user_id ) ? get_userdata( $user_id ) : wp_get_current_user();

			return current( $user->roles );
		}

		/**
		 * Get USer Meta.
		 *
		 * @param array $args Args array.
		 *
		 * @return mixed
		 */
		public static function get_user_meta( $args = [] ) {
			$default = [
				'key'      => '',
				'opt_name' => '',
				'user'     => '',
			];

			$args = wp_parse_args( $args, $default );

			if ( empty( $args['user'] ) ) {
				$args['user'] = get_current_user_id();
			}

			// phpcs:ignore WordPress.PHP.DontExtract
			extract( $args );

			$single = ! empty( $key ) ? true : false;
			$meta   = get_user_meta( $user, $key, $single );

			if ( $single ) { // phpcs:ignore Generic.CodeAnalysis.EmptyStatement
				// Do nothing.
			} elseif ( ! empty( $meta ) ) {
				foreach ( $meta as $key => $value ) {
					if ( is_array( $value ) ) {
						$value        = $value[0];
						$meta[ $key ] = maybe_unserialize( $value );
					} else {
						$meta[ $key ] = maybe_unserialize( $value );
					}
				}
			}
			if ( ! empty( $opt_name ) ) {
				$defaults = self::get_field_defaults( $opt_name );

				$meta = wp_parse_args( $meta, $defaults );
			}

			return $meta;
		}
	}

	Redux_Users::load();
}
