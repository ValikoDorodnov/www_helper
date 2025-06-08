package main

import (
	"context"
	"go.uber.org/goleak"
	"testing"
	"time"
)

func TestGenerate(t *testing.T) {
	defer goleak.VerifyNone(t)
	for i := 0; i < 2; i++ {
		t.Run("test.name", func(t *testing.T) {
			ctx, cancel := context.WithTimeout(context.Background(), 2*time.Second)
			defer cancel()

			c1 := generate(ctx)
			c2 := reverse(ctx, c1)
			printResult(ctx, c2)
		})
	}
}
