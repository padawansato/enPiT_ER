Rails.application.routes.draw do
  root 'home#index'
  get 'toukou' , to: 'home#toukou'

  # For details on the DSL available within this file, see http://guides.rubyonrails.org/routing.html
end
