<template>
  <section class="content">
        <Head title="Hotspot"></Head>
    <ContentHeaderVue :name="'Hotspot'" :icon="'fa fa-picture-o'" />
    <alert :dismissible="true"></alert>
    <BreadCrumb :crumbs="crumbs" />
    <modal v-if="showModal" :errors="errors" :panos="panos"/>
    <button
      type="button"
      class="inline-block mt-6 px-8 py-4 bg-blue-600 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
      data-toggle="modal"
      data-target="#exampleModal"
      @click="clickModal()"
    >Create Hotspot</button>
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" v-if="editMode">Update Hotspot</h5>
            <h5 class="modal-title" id="exampleModalLabel" v-else>Create Hotspot</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="save">
              <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <div class="form-group" :class="errors.category_hotspot_id ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">Category Hotspot:</label>
                    <select
                      id="countries"
                      v-model="form.category_hotspot_id"
                      :class="errors.category_hotspot_id ? 'border-red-500' :''"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                      <option
                        v-for="(category,index) in category_hotspots"
                        :key="index"
                        :value="category.id"
                      >{{category.name}}</option>
                    </select>
                    <div
                      class="text-red-500"
                      v-if="errors.category_hotspot_id"
                    >{{ errors.category_hotspot_id }}</div>
                  </div>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <div class="form-group" :class="errors.icon_id ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">Icon Hotspot:</label>
                    <select
                      id="countries"
                      v-model="form.icon_id"
                      :class="errors.icon_id ? 'border-red-500' :''"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                      <option
                        v-for="(icon,index) in icons"
                        :key="index"
                        :value="icon.id"
                      >{{icon.name}}</option>
                    </select>
                    <div
                      class="text-red-500"
                      v-if="errors.icon_id"
                    >{{ errors.icon_id }}</div>
                  </div>
                </div>
              </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <div class="form-group" :class="errors.name ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">Name:</label>
                    <input
                      type="text"
                      class="form-control text-xl"
                      :class="errors.name ? 'border-red-500' :''"
                      v-model="form.name"
                      id="recipient-name"
                    />
                    <div class="text-red-500" v-if="errors.name">{{ errors.name }}</div>
                  </div>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <div class="form-group" :class="errors.html ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">Text HTML:</label>
                    <input
                      type="text"
                      class="form-control text-xl"
                      :class="errors.html ? 'border-red-500' :''"
                      v-model="form.html"
                      id="recipient-name"
                    />
                    <div class="text-red-500" v-if="errors.name">{{ errors.name }}</div>
                  </div>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                           <div class="form-group" :class="errors.thumb ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">
                      Upload
                      Image (jpg,png)
                    </label>
                    <div class="flex items-center justify-center w-full">
                      <input
                        type="file"
                        @input="form.image = $event.target.files[0]"
                        :class="errors.image ? 'border-red-500' :''"
                        @change="onFileChangeThumb"
                        accept=".jpg, .png"
                      />
                      <img class="w-1/2 h-32 text-gray-400" v-if="image" :src="image" />

                      <div class="text-red-500" v-if="errors.thumb">{{ errors.thumb }}</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex flex-wrap -mx-3 mb-6" v-if="editMode== false">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <div class="form-group" :class="errors.link ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">Link:</label>
                    <input
                      type="text"
                      class="form-control text-xl"
                      :class="errors.link ? 'border-red-500' :''"
                      v-model="form.link"
                      id="recipient-name"
                    />
                    <div class="text-red-500" v-if="errors.link">{{ errors.link }}</div>
                  </div>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <div class="form-group" :class="errors.video ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">Video:</label>
                    <input
                      type="text"
                      class="form-control text-xl"
                      :class="errors.video ? 'border-red-500' :''"
                      v-model="form.video"
                      id="recipient-name"
                    />
                    <div class="text-red-500" v-if="errors.video">{{ errors.video }}</div>
                  </div>
                </div>
              </div>

              <div class="flex flex-wrap -mx-3 mb-6" v-if="editMode== false">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <div class="form-group" :class="errors.description_en ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">Description English:</label>
                    <textarea
                      v-model="form.description_en"

                      :class="errors.description_en ? 'border-red-500' :''"
                      class="form-control block w-full px-3 py-1.5 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                      placeholder="Description English"
                    ></textarea>
                  </div>
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                  <div class="form-group" :class="errors.description_vn ? 'is-valid' :''">
                    <label for="recipient-name" class="col-form-label">Description VietNamese:</label>
                    <textarea
                      v-model="form.description_vn"

                      :class="errors.description_vn ? 'border-red-500' :''"
                      class="form-control block w-full px-3 py-1.5 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                      placeholder="Description VietNamese"
                    ></textarea>
                  </div>
                </div>
              </div>


              <div class="modal-footer">
                <button
                  type="button"
                  class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                  data-dismiss="modal"
                >Close</button>
                <button
                  @click.prevent="save()"
                  type="submit"
                  class="inline-block px-6 py-2.5 bg-gray-800 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out"
                >Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="actionModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Action Hotspot</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="show_list_action col-12">
                        <button class="action_frame col-3"  data-toggle="modal" @click="clickShowModal('showText')"
                      data-target="#actionModal">
                            <div class="action_image">
                                <i class="fa fa-text-width fa-2xs" aria-hidden="true"></i>
                            </div>
                            <p class="action_name">Show Text</p>
                        </button>
                        <button class="action_frame col-3" data-toggle="modal" data-target="#actionModal" @click="clickShowModal('ModalImage')">
                            <div class="action_image">
                                <i class="fa fa-picture-o fa-2xs" aria-hidden="true"></i>
                            </div>
                            <p class="action_name">Popup Image 2D</p>
                        </button>
                        <button class="action_frame col-3" data-toggle="modal" data-target="#actionModal" @click="clickShowModal('ModalFrame')">
                            <div class="action_image">
                                <i class="fa fa-code fa-2xs" aria-hidden="true"></i>
                            </div>
                            <p class="action_name">Popup web frame</p>
                        </button>
                        <button class="action_frame col-3" data-toggle="modal" data-target="#actionModal"  @click="clickShowModal('ModalScene')">
                            <div class="action_image">
                                <i class="fa fa-picture-o fa-2xs" aria-hidden="true"></i>
                            </div>
                            <p class="action_name">Open Scene</p>
                        </button>
                        <button class="action_frame col-3" data-toggle="modal" data-target="#actionModal"  @click="clickShowModal('ModalLink')">
                            <div class="action_image">
                                <i class="fa fa-link" aria-hidden="true"></i>
                            </div>
                            <p class="action_name">Open Link</p>
                        </button>
                        <button class="action_frame col-3" data-toggle="modal" data-target="#actionModal"  @click="clickShowModal('ModalScript')">
                            <div class="action_image">
                                <h1>JS</h1>
                            </div>
                            <p class="action_name">Execute Javascript</p>
                        </button>
                    </div>
            </div>
        </div>
    </div>

    </div>
    <div class="w-full max-w-md mr-4 mb-8 mt-8">
      <input
        v-model="term"
        @keyup="search"
        class="relative w-full px-8 py-3 text-xl rounded-r focus:shadow-outline"
        autocomplete="off"
        type="text"
        name="search"
        placeholder="Search…"
      />
    </div>
    <div class="flex flex-col mt-6">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >id</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >name</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >HTML</th>
                                    <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Style</th>
                                                      <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Ath</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Atv</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Linkedscene</th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Action</th>

                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xl font-back text-gray-500 uppercase tracking-wider"
                  >Content</th>

                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="(hotspot,index) in  hotspots.data" :key="index">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="ml-4">
                        <div class="text-xl font-medium text-gray-900">{{ index }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">
                      <Link :href="route('tour.content.index', hotspot.id)">{{ hotspot.name }}</Link>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">
                      <Link :href="route('tour.content.index', hotspot.id)">{{ hotspot.html }}</Link>
                    </div>
                  </td>
                   <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">
                      <div class="text-xl font-medium text-gray-900">{{ hotspot.style }}</div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">
                      <div class="text-xl font-medium text-gray-900">{{ hotspot.ath }}</div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">
                      <div class="text-xl font-medium text-gray-900">{{ hotspot.atv }}</div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-xl text-gray-900">
                      <div class="text-xl font-medium text-gray-900">{{ hotspot.linkedscene }}</div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-2xl text-gray-900 ">
                      <div class=" justify-center space-x-2">
                      <span
                      @click="onClearAction(hotspot.id,'onload')"
                        class="px-4 py-2 rounded-full text-gray-500 border border-gray-300 font-semibold text-xl flex align-center w-max cursor-pointer active:bg-gray-300 transition duration-300 ease">
                        onload: {{ hotspot.onload }}
                        <button v-if="hotspot.onload" class="bg-transparent hover focus:outline-none">
                          <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times"
                            class="w-3 ml-3" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
                            <path fill="currentColor"
                              d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                            </path>
                          </svg>
                        </button>
                      </span>
                      <span
                      @click="onClearAction(hotspot.id,'onloaded')"
                        class="px-4 py-2 rounded-full text-gray-500 border border-gray-300 font-semibold text-xl flex align-center w-max cursor-pointer active:bg-gray-300 transition duration-300 ease">
                        onloaded: {{ hotspot.onloaded }}
                        <button v-if="hotspot.onloaded" class="bg-transparent hover focus:outline-none">
                          <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times"
                            class="w-3 ml-3" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
                            <path fill="currentColor"
                              d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                            </path>
                          </svg>
                        </button>
                      </span>
                      <span
                        @click="onClearAction(hotspot.id,'onhover')"
                        class="px-4 py-2 rounded-full text-gray-500 border border-gray-300 font-semibold text-xl flex align-center w-max cursor-pointer active:bg-gray-300 transition duration-300 ease">
                        onhover: {{ hotspot.onhover }}
                        <button v-if="hotspot.onhover" class="bg-transparent hover focus:outline-none">
                          <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times"
                            class="w-3 ml-3" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
                            <path fill="currentColor"
                              d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                            </path>
                          </svg>
                        </button>
                      </span>
                       <span
                       @click="onClearAction(hotspot.id,'onclick')"
                        class="px-4 py-2 rounded-full text-gray-500 border border-gray-300 font-semibold text-xl flex align-center w-max cursor-pointer active:bg-gray-300 transition duration-300 ease">
                        onclick: {{ hotspot.onclick }}
                        <button v-if="hotspot.onclick" class="bg-transparent hover focus:outline-none">
                          <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times"
                            class="w-3 ml-3" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
                            <path fill="currentColor"
                              d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                            </path>
                          </svg>
                        </button>
                      </span>
                    </div>

                    </div>
                </td>

                  <td class="px-6 py-4 whitespace-nowrap">
                    <Link
                      :href="route('tour.content.index', hotspot.id)"
                      class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                      @click="edit(hotspot)"
                    >Content</Link>
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button
                      data-toggle="modal"
                      data-target="#actionModal"
                      class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                      @click="Action(hotspot)"
                    >Action</button>
                    <button
                      data-toggle="modal"
                      data-target="#exampleModal"
                      class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out"
                      @click="edit(hotspot)"
                    >Update</button>
                    <button
                      @click="deleteRow(hotspot.id)"
                      class="inline-block px-6 py-2.5 bg-gray-800 text-white font-black text-xl leading-tight uppercase rounded shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out"
                    >Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
            <pagination class="mt-6" :links="hotspots.links" />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapState } from "vuex";
import { Link, Head } from "@inertiajs/inertia-vue";
import Layout from "@/Pages/Tour/Layout";
import ContentHeaderVue from "@/Components/Layout/ContentHeader";
import Pagination from "@/Components/Pagination";
import Alert from "@/Components/Alert";
import BreadCrumb from "@/Pages/Tour/BreadCrumb";
import Icon from "@/Components/Icon";
import Modal from "@/Pages/Tour/Hotspot/Modal/Modal";
export default {
  layout: Layout,
  components: {
    Link,
    ContentHeaderVue,
    Pagination,
    Alert,
    BreadCrumb,
    Icon,
    Head,
    Modal
  },
  props: {
    pano: Object,
    tour: Object,
    errors: Object,
    hotspots: Object,
    category_hotspots: Array,
    icons:Array,
    panos: Array
  },
  computed: {
    ...mapState("fm", {
      showModal: state => state.tour.showModal,
    })
  },

  data() {
    return {
      term: null,
      editMode: false,
      image: null,
      editorData: "<p>Content of the editor.</p>",
      editorConfig: {
        // The configuration of the editor.
      },
      form: this.$inertia.form({
        id: null,
        name: null,
        html : null,
        category_hotspot_id: null,
        video: null,
        description_vn: null,
        description_en:null,
        image: null,
        link: null,
        icon_id:null
      }),
      crumbs: [
        {
          route: "tour.index",
          parma: null,
          name: "Tour"
        },
        {
          route: "tour.pano.index",
          parma: this.tour.id,
          name: "Panos"
        },
        {
          route: "tour.pano.index",
          parma: this.tour.id,
          name:this.pano.name
        },

        {
          route: "tour.pano.hotspot.index",
          parma: [this.tour.code, this.pano.id],
          name: "Hotspots"
        }
      ]
    };
  },
  methods: {
    search() {
      this.$inertia.get(
        this.route("tour.pano.hotspot.index", [this.tour.code, this.pano.id]),
        { term: this.term },
        {
          preserveState: true
        }
      );
    },
    save() {
      if (this.editMode) {
        this.form.post(route("tour.hotspot.update", this.form.id), {
          preserveState: true,
          onError: errors => {
            if (Object.keys(errors).length > 0) {
              this.editMode = true;
            }
          },
          onSuccess: page => {
            $("#exampleModal").modal("hide");
            this.reset();
          }
        });
      } else {
        this.form.post(route("tour.hotspot.store", this.pano.id), {
          preserveState: true,
          onError: errors => {
            if (Object.keys(errors).length > 0) {
              this.editMode = false;
            }
          },
          onSuccess: page => {
            $("#exampleModal").modal("hide");
            this.reset();
          }
        });
      }
    },
    reset: function() {
      this.form = this.$inertia.form({
        id: null,
        name: null,
        category_hotspot_id: null,
        video: null,
        description_vn: null,
        description_en:null,
        image: null,
        link: null,
        icon_id:null
      });
    },

    clickModal() {
      this.editMode = false;
      this.reset();
          $("#exampleModal").on("shown.bs.modal", function() {
        $("#recipient-name").focus();
      });
    },
    edit(data) {
      this.editMode = true;
      this.form.id = data.id;
      this.form.name = data.name;
      this.form.category_hotspot_id = data.category_hotspot_id;
      this.form.icon_id = data.icon_id;
          $("#exampleModal").on("shown.bs.modal", function() {
        $("#recipient-name").focus();
      });
    },
    deleteRow(id) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(route("tour.hotspot.delete", id));
    },
    onFileChangeThumb(e) {
      const file = e.target.files[0];
      this.image = URL.createObjectURL(file);
    },
    clickShowModal(modalName) {
      // show selected modal
      this.$store.commit("fm/tour/setModalState", {
        modalName,
        show: true
      });
    },
    Action(data){
       this.$store.commit('fm/tour/selectHotspt',{
          hotspot: data,
       })
    },
    onClearAction(id, type_action) {
      let query = {
        type_action: type_action
      };
      this.$inertia.post(route("tour.hotspot.clearAction",id), query, {
        preserveState: false
        // only: ["image360s", "errors", 'flash'],
      });
    }
  }
};
</script>

<style>
    .action_frame{
        width: 120px;
        height: 80px;
        margin: 5px;
        text-align: center;
        border: 1px solid #8080808f;
    }
    .show_list_action{
        width: 100%;
        display: flex;
        flex-wrap: wrap;
    }
    .action_image{
        height: 50px;
    }
    .action_image i{
        width: 100%;
        font-size: 30px;
        padding: 10px;
    }
    .action_image h1{
        font-size : 40px;
        font-weight: 600;
    }

</style>
