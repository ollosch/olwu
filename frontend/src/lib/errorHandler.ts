import router from '@/router'
import type { ApiError, LaravelErrors, ResponseErrors } from '@/lib/http'

export function handleHttpErrors(
  status: number | undefined,
  data: { message?: string; errors?: LaravelErrors },
): ApiError | false {
  const message = data?.message

  switch (status) {
    case 401: {
      router.push('/login')
      // toast('You are logged out. Please log in again.')
      return { type: 'auth', message }
    }

    case 403: {
      if (message === 'Email not verified') {
        // toast('Please verify your email')
      }
      return { type: 'forbidden', message }
    }

    case 422: {
      if (data.errors) {
        return { type: 'validation', errors: mapLaravelErrors(data.errors) }
      }
      break
    }
  }

  return false
}

function mapLaravelErrors(laravelErrors: LaravelErrors) {
  const errors: ResponseErrors = {}

  if (laravelErrors) {
    Object.keys(laravelErrors).forEach((key) => {
      const errorValue = laravelErrors[key]

      if (errorValue) {
        errors[key] = Array.isArray(errorValue) ? errorValue[0] || '' : errorValue
      }
    })
  }

  return errors
}
